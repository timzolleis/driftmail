See [Wiki](https://github.com/TimZolleis/mailservice/wiki) for more information






### Projects

After logging in, you can view and create projects on the homescreen. Projects are essentially containers that contain variables, templates and a mail configuration - all under a single API-key. To use this service, you'll need atleast 1 project. We recommend creating an own project for each service you plan to use draftmail with.


### Variables

After creating and opening a project, you can create, edit and delete variables. But what are variables?

Variables are a way to feed dynamic data into **templates** (well talk about them later). U can predefine a variable name (the text that will be searched for in your text) and a key (which is essentially the path to variable in the **variables object**.

Variables have to total scopes and three "small" scopes - with total differentiating if it's a recipient-specific variable, that will be generated and replaced in each email individually, or if its a global variable that only references to non-recipient specific stuff such as an event name, company name etc. 

To fine-grain your variable usage, you can set variables to only apply to the subject of the mail or its body - or if you want to replace them in both, you can set them to "all"

##### Variable usage example

**Subject:** Welcome, {user}

### Templates

After creating and opening a project, you can create, edit and delete templates. But what are templates?

A template is a way to predefine your email subject and text, so you only have to send the variable name when sending emails. This removes the need for you to generate mail texts in your service and reduces http message size drastically.
Templates can be written using markdown or/and html - you can insert headings, links, underline things or make them bold. The built-in preview that is available when creating a template enables you to write markdown straight in the service, without an external markdown parser.

### Settings

In the project settings you configure anything not related to the email itself, such as SMTP configuration, the API-Key. You can conduct critical operations there aswell, such as deleting or exporting your project.
