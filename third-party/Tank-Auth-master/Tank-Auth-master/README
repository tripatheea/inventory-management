Tank Auth is an authentication library for PHP-framework CodeIgniter. It's based on DX Auth, althouth the code was seriously reworked.


Changelog

1.0.9
PHPass settings are moved to config-file for better control over user data.
1.0.8
Some technical changes to make the library compatible with CodeIgniter v.2.0.0.
1.0.7
New parameter 'db_table_prefix' is added to config-file. It defines prefix prepended to every table name (except 'ci_sessions') used by the library.
1.0.6
Resetting forgotten password option is added for non-activated user. Clicking a link in resetting password email activates user as well.
1.0.5
Minor changes resulting from the CI-community feedback.
1.0.4
A sample controller welcome is added, to demonstrate how to use the library. The library successfully tested with OBSession.
1.0.3
Small bug fixes. The database structure is not affected.
1.0.2
SQL injection is fixed (thanks to Laurentvw).
1.0.1
use_username config-parameter is added. Now username is optional (only email is necessary).
1.0.0
The library is released.


Features

The key points of the library are:

It's simple
* Basic auth options (login, logout, register, unregister).
* Very compact (less than 20 files and 4 DB-tables).
* Username is optional, only email is obligatory.

It's secure
* Using phpass library for password hashing (instead of unsafe md5).
* Counting login attempt for bruteforce preventing (optional). Failed login attempts determined by IP and by username.
* Logging last login IP-address and time (optional).
* CAPTCHA for registration and repetitive login attempt (optional).
* Unactivated accounts and forgotten password requests auto-expire.

It's easy to manage
* Strict MVC model: controller for controlling, views for representation and library as model interface.
* Language file support.
* View files contain only necessary HTML code without redundant decoration.
* Most of the features are optional and can be tuned or switched-off in well-documented config file.

It's full featured
* Login using username, email address or both (depending on config settings).
* Registration is instant or after activation by email (optional).
* "Remember me" option.
* Forgot password (letting users pick a new password upon reactivation).
* Change password or email for registered users.
* Email or password can be changed even before account is activated.
* Ban user (optional).
* User Profile (optional).
* CAPTCHA support (CI-native and reCAPTCHA are available).
* HTML or plain-text emails.


Installing Tank Auth

1. Download the latest version of the library.
2. Unzip the package.
3. Copy the application folder content to your CI application folder.
4. Copy the captcha folder to your CI folder. Make sure this folder is writable by web server.
5. Install database schema into your MySQL database.
6. Open the application/config/config.php file in your CI installation and change $config['sess_use_database'] value to TRUE.
That's it!
Please don't forget to look into config files (tank_auth.php and email.php) if something will go wrong. The library should work perfectly right after installation, but depending on your server condition and your own needs some options would better be changed.
WARNING: By default the library generates strong system-specific password hashes that are not portable. It means that once created, user database cannot be dumped and exported to another server. This behavior can be changed in config-file as well.


The library in a nutshell

The library uses MVC model, which means that all database-related methods are incapsulated in model files, and the library itself is used as interface to these methods. A controller (auth) dispatches incoming requests, calls the library methods and renders corresponding views (to show in browser or to send as emails). The controller includes the following methods:

* login: Login user on the site. If login is successful and user account is activated, s/he is redirected to the home page. If account is not activated, then send_again is invoked (see below). In case of login failure user remains on the same page.

* logout: Logout user.

* register: Register user on the site. If registration is successful, a new user account is created. If email_activation flag in config-file is set to TRUE, then this account have to be activated by clicking special link sent by email; otherwise it is activated already. Please notice: after registration user remains unauthenticated; login is still required.

* send_again: Send activation email again, to the same or new email address. This method is invoked every time after non-activated user logins on the site. It may be useful when user didn't receive activation mail sent on registration due to problem with mailbox or a misprint in email address. User may change their email or leave it as is.

* activate: Activate user account. Normally this method is invoked by clicking a link in activation email. Clicking a link in "forgot password" email activates account as well. User is verified by user Id and authentication code in the URL.

* forgot_password: Generate special reset code (to change password) and send it to user. Obviously this method may be used when user has forgotten their password.

* reset_password: Replace user password (forgotten) with a new one (set by user). The method can be called by clicking on link in mail. User is verified by user Id and authentication code in the URL.

* change_password: "Normal" password changing (as compared with resetting forgotten password). Can be called only when user is logged in and activated. For higher security user's old password is needed.

* change_email: Change user's email. Can be called only when user is logged in and activated. For higher security user's password is required. The new email won't be applied until it is activated by clicking a link in a mail sent to this email address.

* reset_email: Activate new email address and replace user's email with a new one. This method can be called by clicking a link in mail. User is verified by user Id and authentication code in the URL.

* unregister: Delete user account. Can be called only when user is logged in and activated. For higher security user's password is required.

Since the auth controller does all the management of user account (including login and logout), so it unlikely that you will have to call the most of the library methods directly. But some of them definitely you will:

* is_logged_in: Check if user logged in on the site.

* get_user_id: Get user_id if user is logged in on the site, FALSE otherwise.

* get_username: Get username for authenticated user, FALSE otherwise. This method is meaningless if username is not used on registration (in this case it returns an empty string for every user).