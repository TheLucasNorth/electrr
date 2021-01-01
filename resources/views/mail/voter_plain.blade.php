{{$election->name}}

Hello!
You've been invited to take part in an online election. You can vote straight away by using the link below, or log in manually with the details provided.

Vote now: /elections/{{$election->slug}}/login/{{$voter->username}}/{{$voter->password_plain}}

Or please visit /elections/{{$election->slug}} to log in, using the following voting code and security code:
Voting Code: {{$voter->username}}
Security Code: {{$voter->password_plain}}

Regards,


If you would rather not receive emails like this, please click here: %tag_unsubscribe_url%.
If you would like to opt out of all future election invites, please click here: %unsubscribe_url%
