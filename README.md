See [Wiki](https://github.com/TimZolleis/mailservice/wiki) for more information

Note: For the usage with NodeJS, we recommend using the [Driftmail Client](https://www.npmjs.com/package/driftmail). However, if you want to make your own HTTP requests or simply try out the service, you can send those as described here.


## Setting up the service

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

## Sending an email

To send an email, you'll just have to send a POST request to the service endpoint, https://yourservicedomain.com/api/mail/send.

In that request youll have to provide an `X-API-KEY` header with the API-Key from your project settings, aswell as a JSON body with **three objects**


### The "mail" object
In the mail object you can now only configure the template that is going to be used. For example: 
```json
{
   "mail":{
      "template":"InvitationTemplate"
   }
}
```
### The "variables" object
The variables object will hold all variables that are **non-recipient-specific** (as configured in the project). Here you can provide simple key-value objects but deeply nested objects aswell (set your path in the project with dot annotation, such as "event.name" in this example)

```json
{
   "variables":{
      "event":{
         "name":"My event",
         "location":"My event location",
         "date":"01/22/23"
      }
   }
}
```

### The "recipients" array
This is an array of objects (essentially those are all the people you'll send your email to) which have to have atleast the `mailAddress` property on them. You can also provide user specific variables, such as name, links etc. For example: 

```json
{
   "recipients":[
      {
         "mailAddress":"mail@example.com",
         "variables":{
            "name":"John Doe",
            "link":"myevent.com/invitation/johndoe"
         }
      },
      {
         "mailAddress":"mail2@example.com",
         "variables":{
            "name":"Jeanette Doe",
            "link":"myevent.com/invitation/jeanettedoe"
         }
      }
   ]
}
```

### Example
To put this all together, this is what an example body of the POST request might look like: 

```json
{
   "mail":{
      "template":"InvitationTemplate"
   },
   "variables":{
      "event":{
         "name":"My event",
         "location":"My event location",
         "date":"01/22/23"
      }
   },
   "recipients":[
      {
         "mailAddress":"mail@example.com",
         "variables":{
            "name":"John Doe",
            "link":"myevent.com/invitation/johndoe"
         }
      },
      {
         "mailAddress":"mail2@example.com",
         "variables":{
            "name":"Jeanette Doe",
            "link":"myevent.com/invitation/jeanettedoe"
         }
      }
   ]
}
```











