Feature: Recipe

  AS A user
  I WANT details on an individual recipe
  SO THAT I am able to cook it

  Scenario: Recipe doesn't exist

    When a recipe is visited that cannot be found
    Then the message "Sorry, this recipe doesn't exist or may have been removed" is displayed

  Scenario: Recipe cooking time

    Given the system has the following recipe cooking times:
      | Recipe              | Cooking Time |
      | Sapphire's stir-fry | 30 minutes   |
    When the "Sapphire's stir-fry" recipe is visited
    Then the cooking time of "30 minutes" is displayed

  Scenario: Recipe image

    Given the system has the following recipe image:
      | Recipe              | Image                          |                                                  |
      | Sapphire's stir-fry | sachas_stir-fry_17077_16x9.jpg |
    When the "Sapphire's stir-fry" recipe is visited
    Then the image "sachas_stir-fry_17077_16x9.jpg" is displayed

  Scenario: Recipe ingredients

    Given the system has the following recipe ingredients for "Sapphire's stir-fry":
      | Ingredient                                                |
      | 2 tbsp sunflower oil                                      |
      | 4 spring onions, cut into 4cm/1½in lengths                |
      | 1 garlic clove, crushed                                   |
      | piece fresh root ginger, about 1cm/½in, peeled and grated |
    When the "Sapphire's stir-fry" recipe is visited
    Then the ingredients are listed in the order given

  Scenario: Recipe ingredient group

    Given the system has the following recipe ingredients for "Easy chocolate cake":
      | Ingredient                  | Group                   |
      | 225g/8oz plain flour        | For the cake            |
      | 350g/12½oz caster sugar     | For the cake            |
      | 200g/7oz plain chocolate    | For the chocolate icing |
      | 200ml/7fl oz double cream   | For the chocolate icing |
    When the "Easy chocolate cake" recipe is visited
    Then the ingredients are listed by group in the order given

  Scenario: Recipe preparation method

    Given the system has the following recipe preparation steps for "Easy chocolate cake":
      | Step                                                                                                                |
      | Preheat the oven to 180C/350F/Gas 4. Grease and line two 20cm/8in sandwich tins.                                    |
      | Spread a little chocolate icing over the top of one of the chocolate cakes, then carefully top with the other cake. |
      | Transfer the cake to a serving plate and ice the cake all over with the chocolate icing, using a palette knife.     |
    When the "Easy chocolate cake" recipe is visited
    Then the preparation steps are listed in the order given

  Scenario: Go back to recipe list

    Given I am on the "Sapphire's stir-fry" recipe
    When I click "Back"
    Then the recipe list is displayed
