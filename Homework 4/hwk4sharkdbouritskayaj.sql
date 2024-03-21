USE sharkdbouritskayaj;

-- 1.
SELECT sid, name, detections AS sightings FROM shark;

-- 2.
SELECT bayside AS bay_name, SUM(detections) AS detections 
FROM receiver 
GROUP BY bayside 
ORDER BY detections DESC;

-- 3.
SELECT MAX(length) AS longest FROM shark;

-- 4. 
SELECT r.area, t.town, t.state, r.detections AS number_of_detections
FROM receiver AS r
JOIN township AS t
on r.location = t.tid
ORDER BY detections DESC
LIMIT 1;

-- 5.
SELECT * FROM receiver WHERE individual_sharks_detected = (SELECT COUNT(*) FROM shark);

-- 6.
CREATE TABLE bayside_encounters AS
SELECT *
FROM receiver
WHERE bayside IS NOT NULL;

-- 7.
SELECT s.sid, s.name, g.sex, s.length, s.detections
FROM shark AS s
JOIN gender AS g
JOIN attack as a
ON a.shark = s.sid;

-- 8. 
SELECT bayside AS bay_name, group_concat(DISTINCT area) AS area_names 
FROM receiver 
GROUP BY bay_name;

-- 9. 
SELECT name 
FROM shark 
WHERE length = (SELECT MAX(length) FROM shark);

-- 10.
SELECT t.town, t.state, SUM(r.detections) AS shark_sightings
FROM township AS t 
JOIN receiver AS r 
ON r.location = t.tid 
GROUP BY t.town, t.state;

-- 11. 
SELECT t.town, t.state, SUM(r.detections) AS detections
FROM township AS t 
JOIN receiver AS r 
ON r.location = t.tid 
GROUP BY t.town, t.state
ORDER BY detections DESC
LIMIT 1;

-- 12.
 SELECT * FROM shark WHERE length < 8 ORDER BY length;
 
 -- 13. 
 SELECT COUNT(*) FROM shark WHERE sex = 'Female';
 
 -- 14. 
SELECT t.town, t.state, SUM(r.detections) AS shark_sightings
FROM township AS t 
LEFT OUTER JOIN receiver AS r 
ON r.location = t.tid 
GROUP BY t.town, t.state;

-- 15. 
SELECT s.sponsor_name, COUNT(r.sponsor) AS count
FROM sponsor AS s
JOIN receiver AS r
ON s.sponsor_name = r.sponsor
GROUP BY s.sponsor_name;

-- 16.
SELECT sponsor, SUM(detections) AS detections 
FROM receiver
GROUP BY sponsor;

-- 17.
SELECT a.shark, a.fatal, a.description, a.date, a.activity, t.town, t.state, v.name, v.age
FROM attack AS a
JOIN township AS t ON a.location = t.tid
JOIN victim AS v ON a.victim = v.vid;

-- 18.
SELECT t.town, t.state, MIN(r.deployed) AS date_of_deployment
FROM receiver r
JOIN township t ON r.location = t.tid
GROUP BY t.town, t.state
ORDER BY date_of_deployment
LIMIT 1;

-- 19. 
SELECT t.town, t.state, COUNT(r.location) AS num_receivers
FROM township AS t 
LEFT OUTER JOIN receiver AS r 
ON r.location = t.tid 
GROUP BY t.town, t.state;

-- 20. 
SELECT town, state 
FROM township 
WHERE tid NOT IN (SELECT DISTINCT location FROM receiver) 
AND tid NOT IN (SELECT DISTINCT location FROM attack);