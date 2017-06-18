# smi_final_1617
This is the repository for the final smi project.
## Objectives
 * Summarize key features of relevant and emerging technologies in the area of Content Management Systems;
 * Consolidation of the concepts of language / PHP infrastructure presented in class;
 * Building dynamic Web applications and Content Management Systems;
 * Web applications accessing external systems, for example:
    * Database;
    * Electronic Mail;
    * Google Services;
 * Visualization of multimedia content (i.e. photographs, videos and audios)
 * Incorporate the usage of Web Services in Web applications;
 * Use and development of mashups;
 * Structuring distributed applications according to the client / server model.

## Design
 * Guest – this profile is the most restrictive of all and only lets you view and search the public contents available in the system. Searches can be made based on the categories and associated metadata to content.

 * User – this profile includes the functionality of the previous profile and adds the following:
  * Subscribe notifications of new events added to the system. The users are only notified if the new events match the user interests.

 * Supporter – this profile includes the functionality of the previous profile and adds the following:
  * Creation of secondary categories;
  * Association of categories (major and minor) and metadata to the content that is sent to the server;
  * Add new events to the system.

 * Administrator – this profile includes the functionality of the previous profile and adds the following:
  * Database access Definitions;
  * Settings of the email service;
  * Management of content categories;
  * User management.

Obtaining and sending ads can be performed as a unit or in batch. If they are made in the batch, content and its metadata are combined in a single file with a ZIP extension. The metadata of all content is grouped in a single XML file.

In addition to the features described above the system may include:
 * Installation and configuration of the CMS on an empty web server;
 * Registration of new users automatically;
 * Sending e-mail messages or generate RSS Feeds (Rich Site Summary) to registered users, when new events are added in predefined categories;
 * Sharing of new events on social networks (such as Facebook and Twitter);
 * View the event location on a map (for example using the Google Maps API);

## Implementation
The work must be performed in the following phases:
 * Problem analysis:
    * Identification of the main modules / components;
    * Identification of features supported by the system;
    * Used data structures;
 * Web Application Development to provide the specified features
 * Tests to prove the correct operation of the application

## Database

This is our second database sketch.

![Database](misc/database_sketch2.PNG "Initial database sketch")

## References

[Git repository](https://github.com/tomazinhal/smi_final_1617)

## History

* 23-05-2017: Inital commit.

* 25-05-2017: Initial sketch of the website's main page and registration/email verification

* 18-06-2017: Database update to hold notification requirements. Login, Logout, Events, Posting all implemented. 