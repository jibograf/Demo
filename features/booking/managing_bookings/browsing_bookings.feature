@managing_bookings
Feature: Browsing bookings
    In order to see all bookings
    As an Administrator
    I want to browse bookings

    Background:
        Given there is an animal with name "Kitty"
        And this animal has been booked by customer "cruella@101dalamatiens.com"
        And I am logged in as an administrator

    @ui
    Scenario: Browsing bookings
        When I want to see all bookings
        Then I should see 1 bookings in the list
        And I should see the booking for the animal "Kitty" in the list
