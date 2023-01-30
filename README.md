

## Preparation
In order to use Mailservice in your projects, you’ll need to login and create a project first. The following login providers are available
- Netlify
- Github
After successfully logging in, you have the ability to create projects, templates and variables
### Projects
Projects are used to differentiate between applications or mail sending providers, effectively requiring a unique API-Key to be sent with the request. Whilst the mail provider configuration (e.g SMTP) and the API-Key are tied to a project, you can use templates and variables with each project that you have created.

### Variables
Variables are a way to inject dynamic content generated in your application to your predefined mail templates, so you do not have to generate the mail text in your application. You can either specify **local** or **global** variables
#### Local variables
- Local variables are tied to the **variables** field on a recipient (see *Example Request*) which makes them perfect for providing user-specific details such as names, links, codes etc. when sending to multiple users at once
#### Global variables
- Global variables are tied to the **variables** field on the **mail** object. Since they are not user-specific and the same for all recipients, they are perfect for specifying general dynamic data, such as an event location or maybe a date. 
To use variables, you need to configure a variable by key and value in the variables field and specify its scope
#### Key
- The  key is the value in curly braces (e.g {{name}}) that is parsed in the text. Insert the variable keys in the template text to use them
#### Value
- The value is the „path“ to look for on the **request variable object**. You can use dot annotation to specify paths in a JSON Object (for example user.name) or just the key if its a field in the **variables** object

Please keep in mind that you can use variables aswell when manually overriding the subject or the mail body in the request (see *Template override*) - so there is no need for you to create a variable parsing system yourself.

### Templates
Mail templates are a way to pre-specify the mail subject or/and mail body, so you do not have to store and generate the mail content on your system. To create a template specify its name (e.g. „Event invitation“), provide a subject and a body and save it. Please keep in mind that the name when providing a template is **not case-sensitive**.

## Usage
To use the Mailservice in your application, all you need to do is to fetch two endpoints after you‘ve setup your project. 
1. mailservice.zolleis.net/api/mail/send to send the mail
2. mailservice.zolleis.net/api/mail/status/{requestId} to check the status of your previously made request.

### Sending an email
To send an email, you can either use the **nodejs** client or use an http client of your choice. However, you need to provide the API-Key and an **email object** for the server to parse.
To provide an API-Key, you’ll need to include the API-key you set in your project as the “X-API-KEY” Header in your request.

### The email object
The email object consists out of an object that has to fields: **mail** and **recipients**. In the **mail** field you can either provide a template name or/and subject and body, aswell as a **variables** field with the respective keys to variables you created in your configuration. Please keep in mind that variables that are **not configured** in your application wont be parsed
In the **recipients** field, which is effectively (at minimum) an array of objects that contain an email address, you can specify who to send the email to. Here you can aswell introduce local variables, for example as username that should be replaced in the mail subject /text

### Example:
```json
{
	mail: {
		template: ”Invitation”,
		variables: {
			event: {
				name: “My special event
			}
		},
	},
	recipients: [
		{
		mailaddress: “example@test.com”,
		variables: {
			Name: “Example name” 
			}
		}
	]
}
```

### Checking the email status
