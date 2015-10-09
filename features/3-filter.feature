Feature: Filter recipes

  AS A user
  I WANT to filter through recipes
  SO THAT I can quickly get to the ones I am looking for

  Background:

    Given the following recipes exist in the system:
      | Name                | Cooking Time | Image                               |
      | Sapphire's stir-fry | 30 minutes   | sachas_stir-fry_17077_16x9.jpg      |
      | Easy chocolate cake | 60 minutes   | easy_chocolate_cake_31070_16x9.jpg  |
      | Chicken Kiev        | 40 minutes   | chickenkievwithmashe_83483_16x9.jpg |

  Scenario: No results

    When the filter term "Lasagne" is entered
    Then the message "Sorry, nothing matched your filter term" is displayed

  Scenario: Filter results by name

    When the filter term "Chicken" is entered
    Then the following recipes are displayed:
      | Name                | Cooking Time | Image                               |
      | Chicken Kiev        | 40 minutes   | chickenkievwithmashe_83483_16x9.jpg |

  Scenario: Filter results by ingredient

    When the filter term "Courgette" is entered
    Then only the following recipe is displayed:
      | Name                | Cooking Time | Image                          |
      | Sapphire's stir-fry | 30 minutes   | sachas_stir-fry_17077_16x9.jpg |
