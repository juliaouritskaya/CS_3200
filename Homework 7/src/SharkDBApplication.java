import java.sql.*;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;
import java.util.Scanner;


public class SharkDBApplication {
  public static void main(String[] args) {
    String username = promptUser("Enter MYSQL username: ");
    String password = promptUser("Enter MYSQL password: ");

    Connection connection = null;
    try {
      String url = "jdbc:mysql://localhost:3306/sharkdbouritskayaj";
      connection = DriverManager.getConnection(url, username, password);

      List<String> validTowns = getValidTowns(connection);

      String town = "";
      String state = "";

      while (true) {
        town = promptUser("Enter a town: ");
        state = promptUser("Enter a state: ");

        if (isValidInput(town, state, validTowns)) {
          break;
        } else {
          System.out.println("Invalid input. Please try again.");
        }
      }

      callAllReceiversProcedure(connection, town, state);


    } catch (SQLException e) {
      e.printStackTrace();
    } finally {
      if (connection != null) {
        try {
          connection.close();
        } catch (SQLException e) {
          e.printStackTrace();
        }
      }
      System.exit(0);
    }
  }

  private static String promptUser(String message) {
    System.out.print(message);
    Scanner scanner = new Scanner(System.in);
    return scanner.nextLine();
  }

  private static List<String> getValidTowns(Connection connection) throws SQLException {
    List<String> validTowns = new ArrayList<>();
    String query = "SELECT town FROM township";
    Statement statement = connection.createStatement();
    ResultSet resultSet = statement.executeQuery(query);
    while (resultSet.next()) {
      String town = resultSet.getString("town");
      validTowns.add(town);
    }
    resultSet.close();
    statement.close();
    return validTowns;
  }

  private static boolean isValidInput(String town, String state, List<String> validTowns) {
    String formattedTown = formatTown(town);

    String uppercaseState = state.toUpperCase();

    for (String validTown : validTowns) {
      String formattedValidTown = formatTown(validTown);

      if (formattedValidTown.equals(formattedTown)) {
        if (isValidState(uppercaseState)) {
          return true;
        }
      }
    }
    return false;
  }

  private static boolean isValidState(String state) {
    String uppercaseState = state.toUpperCase();

    List<String> validStates = Arrays.asList("MA", "ME", "RI");
    return validStates.contains(uppercaseState);
  }

  private static String formatTown(String town) {
    String[] words = town.split(" ");

    for (int i = 0; i < words.length; i++) {
      if (!words[i].isEmpty()) {
        char firstChar = Character.toUpperCase(words[i].charAt(0));
        words[i] = firstChar + words[i].substring(1).toLowerCase();
      }
    }
    return String.join(" ", words);
  }

  private static void callAllReceiversProcedure(Connection connection, String town, String state) {
    String sql = "CALL allReceivers(?, ?)";
    ResultSet resultSet = null;
    CallableStatement statement = null;

    try {
      statement = connection.prepareCall(sql);
      statement.setString(1, town);
      statement.setString(2, state);
      resultSet = statement.executeQuery();

      while (resultSet.next()) {
        int receiverId = resultSet.getInt("rid");
        int location = resultSet.getInt("location");
        String sponsor = resultSet.getString("sponsor");
        String area = resultSet.getString("area");
        String deployed = resultSet.getString("deployed");
        String hauled = resultSet.getString("hauled");
        int detections = resultSet.getInt("detections");
        int individualSharksDetected = resultSet.getInt("individual_sharks_detected");
        String bayside = resultSet.getString("bayside");

        System.out.println("Receiver ID: " + receiverId);
        System.out.println("Location: " + location);
        System.out.println("Sponsor: " + sponsor);
        System.out.println("Area: " + area);
        System.out.println("Deployed: " + deployed);
        System.out.println("Hauled: " + hauled);
        System.out.println("Detections: " + detections);
        System.out.println("Individual Sharks Detected: " + individualSharksDetected);
        System.out.println("Bayside: " + bayside);
        System.out.println("---------------------------------");
      }

      System.out.println("allReceivers procedure executed successfully.");
    } catch (SQLException e) {
      e.printStackTrace();
    } finally {
      try {
        if (resultSet != null) {
          resultSet.close();
        }
        if (statement != null) {
          statement.close();
        }
      } catch (SQLException e) {
        e.printStackTrace();
      }
    }
  }
}
