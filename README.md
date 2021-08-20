# Cinema Guide Application

## Introduction
This documentation describes the important notes that the developer has experienced while implementing the application.


## System Architecture

    ### Application Data Model

    The diagram at below path represents the data model that has been considered for the application

    ~\resources\images\diagram.png


    ### Application Workflows overview
        1.	The application allows users to log in to the system. Once the user is logged in he can see the cinema listing.
        2.	Users can see cinemas, add, edit and delete them.
        3.	Users can also see movies, add, edit and delete them.
        4.	Users can also add movies sessions to the cinema and update and delete them
        5.  To use the application and APIs,  a user account will have to be registered by calling the “/api/register” endpoint. This will generate an API Access Token which can be used to access the APIs. Also, you would be able to login into the web portal by using your email id and password used while registering.

## Troubleshooting
Below are some issues that I have experienced during the application development and details about the solution that I have implemented in order to address the issue
    1.	Faced issues with Laravel passport for login/registration functionality, to resolve it, updated the validator syntax.

## API Documentation
The API documentation can be found at the link mentioned below – https://documenter.getpostman.com/view/10608295/TzzDHZev
