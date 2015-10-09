Feature: Order recipes list

  AS A user
  I WANT to order recipes by cooking time
  SO THAT I can see quick recipes first

  Background:

    Given the following recipes exist in the system:
      | Name                | Cooking Time | Image                               |
      | Sapphire's stir-fry | 30 minutes   | sachas_stir-fry_17077_16x9.jpg      |
      | Easy chocolate cake | 60 minutes   | easy_chocolate_cake_31070_16x9.jpg  |
      | Chicken Kiev        | 40 minutes   | chickenkievwithmashe_83483_16x9.jpg |

  Scenario: Order by cooking time

    When recipes are not ordered by cooking time
    And "Order by cooking time" is selected
    Then the recipes are listed by cooking time in ascending order
      | Name                | Cooking Time | Image                               |
      | Sapphire's stir-fry | 30 minutes   | sachas_stir-fry_17077_16x9.jpg      |
      | Chicken Kiev        | 40 minutes   | chickenkievwithmashe_83483_16x9.jpg |
      | Easy chocolate cake | 60 minutes   | easy_chocolate_cake_31070_16x9.jpg  |
  
  Scenario: Order by cooking time descending

    When recipes are already listed by cooking time in ascending order
    And "Order by cooking time" is selected
    Then the recipes are listed by cooking time in descending order
      | Name                | Cooking Time | Image                               |
      | Easy chocolate cake | 60 minutes   | easy_chocolate_cake_31070_16x9.jpg  |
      | Chicken Kiev        | 40 minutes   | chickenkievwithmashe_83483_16x9.jpg |
      | Sapphire's stir-fry | 30 minutes   | sachas_stir-fry_17077_16x9.jpg      |

  Scenario: Order by cooking time ascending

    When recipes are already listed by cooking time in descending order
    And "Order by cooking time" is selected
    Then the recipes are listed by cooking time in ascending order
      | Name                | Cooking Time | Image                               |
      | Sapphire's stir-fry | 30 minutes   | sachas_stir-fry_17077_16x9.jpg      |
      | Chicken Kiev        | 40 minutes   | chickenkievwithmashe_83483_16x9.jpg |
      | Easy chocolate cake | 60 minutes   | easy_chocolate_cake_31070_16x9.jpg  |
