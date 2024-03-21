USE sharkdbouritskayaj;

-- 1. Write a function that returns the township id of the township that had the most number of attacks. 
-- The function accepts no arguments. If there are more than 1 town with the maximum value, return any town with the maximum value.

DROP FUNCTION IF EXISTS mostAttacks;

DELIMITER //

CREATE FUNCTION mostAttacks() RETURNS INT 
READS SQL DATA
BEGIN
	DECLARE maxAttacks INT;
    DECLARE maxTownshipID INT;
    
    SELECT MAX(attacks) INTO maxAttacks
	FROM (
		SELECT COUNT(*) AS attacks
        FROM attack
        GROUP by location
	) AS attack_counts;
    
    SELECT location INTO maxTownshipID
    FROM (
		SELECT location, COUNT(*) AS attacks
        FROM attack
		GROUP BY location
	) AS attack_counts
    WHERE attacks = maxAttacks
    LIMIT 1;
    
    RETURN maxTownshipID;
END //

DELIMITER ;

-- Test the function
SELECT mostAttacks();

-- 2. Write a procedure allReceivers(town, state) that accepts a town name and a state abbreviation 
-- and returns a result set of all receivers in that town. 
-- The result should contain all the fields in the receiver table as well as the provided town and state.

DROP PROCEDURE IF EXISTS allReceivers;

DELIMITER //

CREATE PROCEDURE allReceivers(IN town VARCHAR(64), IN state CHAR(2))
BEGIN
    SELECT r.*, t.town AS receiver_town, t.state AS receiver_state
    FROM receiver r
    INNER JOIN township t 
    ON r.location = t.tid
    WHERE t.town = town AND t.state = state;
END //

DELIMITER ;

-- Test the procedure
CALL allReceivers('Truro', 'MA');
CALL allReceivers('Marshfield', 'MA');

-- 3.  Write a procedure named sharkLenGTE(length_p) that accepts a length for a shark 
-- and returns a result set that contains the shark id, shark name, shark length, shark sex , 
-- and the number of detections for that shark for all sharks with a length greater than or equal to the passed length.

DROP PROCEDURE IF EXISTS sharkLenGTE;

DELIMITER //

CREATE PROCEDURE sharkLenGTE(IN length_p DOUBLE) 
BEGIN
	SELECT s.sid, s.name, s.length, s.sex, s.detections
    FROM shark AS s
    WHERE s.length >= length_p;
END // 

DELIMITER ;

-- Test the procedure
CALL sharkLenGTE(5.0);
CALL sharkLenGTE(10.0);
CALL sharkLenGTE(15.0);

-- 4. Write a function named numSharkWithLen(length_p) that accepts a shark length 
-- and returns the number of sharks with that length.

DROP FUNCTION IF EXISTS numSharkWithLen;

DELIMITER //

CREATE FUNCTION numSharkWithLen(length_p DOUBLE) RETURNS INT 
DETERMINISTIC
BEGIN
	DECLARE num_sharks INT;
	SELECT COUNT(*) INTO num_sharks
    FROM shark 
    WHERE length = length_p;
    
    RETURN num_sharks;
END //

DELIMITER ;

-- Test the function
SELECT numSharkWithLen(5.0);
SELECT numSharkWithLen(10.0);
SELECT numSharkWithLen(15.0);

-- 5. Write a procedure named sightingsByTown() that accepts no arguments and returns a row for each township tuple in the township table. 
-- The result contains the number of sightings per town, the town name and the state abbreviation.

DROP PROCEDURE IF EXISTS sightingsByTown;

DELIMITER //

CREATE PROCEDURE sightingsByTown()
BEGIN
	SELECT COUNT(a.shark) AS num_sightings, t.town, t.state
    FROM attack AS a
    JOIN township AS t
    ON a.location = t.tid
    GROUP BY t.tid;
END //

DELIMITER ;

-- Test the procedure 
CALL sightingsByTown();

-- 6. Write a function named moreDetections(shark1,shark2). It accepts 2 shark names and returns 
-- 1 if shark1 has had more detections than shark2, 
-- 0 if they have had the same number of detections , and 
-- -1 if shark2 has had more detections than shark1.
DROP FUNCTION IF EXISTS moreDetections;

DELIMITER // 

CREATE FUNCTION moreDetections(shark1 VARCHAR(64), shark2 VARCHAR(64)) RETURNS INT
DETERMINISTIC
BEGIN
	DECLARE detections1 INT;
    DECLARE detections2 INT;
    
    SELECT detections INTO detections1
    FROM shark
    WHERE name = shark1;
    
    SELECT detections INTO detections2
    FROM shark 
    WHERE name = shark2;
    
    IF detections1 > detections2 THEN
		RETURN 1;
	ELSEIF detections1 = detections2 THEN
		RETURN 0;
	ELSE 
		RETURN -1;
	END IF;
END //

DELIMITER ;

-- Test the function
SELECT moreDetections('Annie', 'Avery');
SELECT moreDetections('32312', '32310');
SELECT moreDetections('Bertie', 'Bou');

-- 7. Create a procedure named createAttack( sname_p , vname_p , vage_p , fatal_p, attack_date,  activity_p,  description_p ,town_p, state_p ) 
-- that inserts an attack into the database. Make sure you create the appropriate tuples in the victim, shark and township table as well. 
-- Insert another attack into the attack table. victim name = “Ace Ventura”, age = 35, town = “Wellfleet”, state = “MA”,  
-- shark_name = NULL, fatal = 0, date = ‘2021-08-11’, description = “right foot”, activity = “surfing”.

DROP PROCEDURE IF EXISTS createAttack;

DELIMITER //

CREATE PROCEDURE createAttack(
    IN sname_p VARCHAR(64),
    IN vname_p VARCHAR(45),
    IN vage_p INT,
    IN fatal_p CHAR(1),
    IN attack_date DATE,
    IN activity_p VARCHAR(64),
    IN description_p VARCHAR(64),
    IN town_p VARCHAR(64),
    IN state_p CHAR(2)
)
BEGIN
    DECLARE shark_id INT;
    DECLARE victim_id INT;
    DECLARE town_id INT;
    
    -- Check if shark name is NULL
    IF sname_p IS NULL THEN
        SET shark_id = NULL;
    ELSE
        -- Check if shark already exists
        SELECT sid INTO shark_id
        FROM shark
        WHERE name = sname_p
        LIMIT 1;
        
        -- If shark doesn't exist, insert into shark table
        IF shark_id IS NULL THEN
            INSERT INTO shark (name, sex) VALUES (sname_p, 'Unknown');
            SET shark_id = LAST_INSERT_ID();
        END IF;
    END IF;
    
    -- Insert into victim table
    INSERT INTO victim (name, age) VALUES (vname_p, vage_p);
    SET victim_id = LAST_INSERT_ID();
    
    -- Get township ID from township table or insert a new tuple
    SELECT tid INTO town_id
    FROM township
    WHERE town = town_p AND state = state_p
    LIMIT 1;
    
    IF town_id IS NULL THEN
        -- Insert into township table
        INSERT INTO township (town, state) VALUES (town_p, state_p);
        SET town_id = LAST_INSERT_ID();
    END IF;
    
    -- Check if attack with the same date already exists
    IF EXISTS (SELECT * FROM attack WHERE date = attack_date) THEN
        SELECT 'An attack with the same date already exists.' AS message;
    ELSE
        -- Insert into attack table
        INSERT INTO attack (shark, victim, fatal, date, activity, description, location)
        VALUES (shark_id, victim_id, fatal_p, attack_date, activity_p, description_p, town_id);
        
        SELECT * FROM attack; -- Output for testing purposes
    END IF;
END //

DELIMITER ;

-- Test the procedure
CALL createAttack(NULL, 'Ace Ventura', 35, '0', '2021-08-11', 'surfing', 'right foot', 'Wellfleet', 'MA');
CALL createAttack('Tiger Shark', 'Jane Smith', 24, '0', '2023-01-03', 'diving', 'head', 'Boston', 'MA');

-- 8. Modify the township table to track the number of shark attacks for that town. Call the new field numAttacks. 
-- Write a procedure named initialize_num_attack(townid) that initializes the field for a specific  township. 
-- Call the procedure for each town in the attack table.

DROP PROCEDURE IF EXISTS initialize_num_attack;

DELIMITER //

CREATE PROCEDURE initialize_num_attack(townid INT)
BEGIN
	UPDATE township
	SET numAttacks = (
		SELECT COUNT(*)
        FROM attack
		WHERE township.tid = attack.location
	)
	WHERE tid = townid;
    
    SELECT * FROM township WHERE tid = townid;
END //

DELIMITER ;

-- Test the procedure
CALL initialize_num_attack(1);
CALL initialize_num_attack(2);
CALL initialize_num_attack(3);
CALL initialize_num_attack(4);
CALL initialize_num_attack(5);
CALL initialize_num_attack(6);
CALL initialize_num_attack(7);
CALL initialize_num_attack(8);
CALL initialize_num_attack(9);
CALL initialize_num_attack(10);
CALL initialize_num_attack(11);
CALL initialize_num_attack(12);
CALL initialize_num_attack(13);
CALL initialize_num_attack(14);
CALL initialize_num_attack(15);
CALL initialize_num_attack(16);
CALL initialize_num_attack(17);
CALL initialize_num_attack(18);
CALL initialize_num_attack(19);
CALL initialize_num_attack(20);
CALL initialize_num_attack(21);
CALL initialize_num_attack(22);
CALL initialize_num_attack(23);
CALL initialize_num_attack(24);
CALL initialize_num_attack(25);
CALL initialize_num_attack(26);
CALL initialize_num_attack(27);
CALL initialize_num_attack(28);


-- 9. Write a trigger that updates township.numAttacks whenever an attack is added to the attack table.
-- Name the trigger attack_after_insert(). Insert an attack into the attack table to verify your trigger is working;
-- victim name = “Jennifer Jones”, age = 25, town = “Truro”, state = “MA”, sharkid = NULL, fatal = 0, date = ‘2021-11-11’, description = “left foot”, activity = “surfing”.

DROP TRIGGER IF EXISTS attack_after_insert;

DELIMITER //

CREATE TRIGGER attack_after_insert
AFTER INSERT ON attack
FOR EACH ROW
BEGIN
    UPDATE township
    SET numAttacks = numAttacks + 1
    WHERE tid = NEW.location;
END //

DELIMITER ;

-- Test the trigger
CALL createAttack(NULL, 'Jennifer Jones', 25, '0', '2021-11-11', 'surfing', 'left foot', 'Truro', 'MA');

-- 10. Write a trigger that updates township.numAttacks whenever an attack is deleted from the attack table. 
-- Call the trigger attack_after_delete().  Delete the  attack from the attack table to verify your trigger is working;  
-- victim name = “Jennifer Jones”, age = 25, town = “Truro”, state = “MA”,  sharkid = NULL, fatal = 0, date = ‘2021-11-11’, description = “left foot”, activity = “surfing”

DROP TRIGGER IF EXISTS attack_after_delete;

DELIMITER //

CREATE TRIGGER attack_after_delete
AFTER DELETE ON attack
FOR EACH ROW
BEGIN
    UPDATE township
    SET numAttacks = numAttacks - 1
    WHERE tid = OLD.location;
END //

DELIMITER ;

-- Test the trigger
DELETE FROM ATTACK 
WHERE victim = '93';

-- 11. Create and execute a prepared statement from the SQL workbench that calls the function moreDetections(shark1, shark2). 
-- Use 2 user session variables to pass the two arguments to the function. Pass the values “Amy” and “Alex” as the shark variables.

SET @shark1 := 'Amy';
SET @shark2 := 'Alex';

PREPARE stmt FROM 'SELECT moreDetections(?, ?)';
EXECUTE stmt USING @shark1, @shark2;

-- 12. Create and execute a prepared statement from the SQL workbench that calls the function numSharkWithLen(length_p). 
-- Use a user session variable to pass the length to the function. Pass the value 14 as the length.

SET @length := 14;

PREPARE stmt FROM 'SELECT numSharkWithLen(?)';
EXECUTE stmt USING @length;





