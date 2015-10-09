Feature: Recipe list

  AS A user
  I WANT to find recipes
  SO THAT I can get inspiration for cooking

  Scenario: No recipes available

    When there are no recipes in the system
    Then the message "Sorry, we currently have no recipes for you" is displayed

  Scenario: One recipe available

    When the following recipes exist in the system:
      | Name                | Cooking Time | Image                          |
      | Sapphire's stir-fry | 30 minutes   | sachas_stir-fry_17077_16x9.jpg |
    Then the recipe "Sapphire's stir-fry"
    And the cooking time of "30 minutes"
    And the image "sachas_stir-fry_17077_16x9.jpg" are displayed

  Scenario: Multiple recipes

    When the following recipes exist in the system:
      | Name                | Cooking Time | Image                               |
      | Sapphire's stir-fry | 30 minutes   | sachas_stir-fry_17077_16x9.jpg      |
      | Easy chocolate cake | 60 minutes   | easy_chocolate_cake_31070_16x9.jpg  |
      | Chicken Kiev        | 40 minutes   | chickenkievwithmashe_83483_16x9.jpg |
    Then the recipes along with their cooking time and image are listed

  Scenario: Select a recipe

    When a recipe is selected
    Then I am taken to the recipe page

  Scenario: Multiple pages of recipes

    When there are more than 10 recipes in the system
    Then only the first 10 recipes are shown

  Scenario: Navigating multiple pages of recipes

    When there are more than 10 recipes in the system
    Then page navigation elements are displayed
