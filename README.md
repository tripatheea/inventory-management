Inventory Management
====================
This is a simple web-based inventory management software written in PHP (MySQL) with CodeIgniter. This was specifically written for a high school but with a bit of tweaking, should work fine for others too.

Features
-------
- Typical inventory-management. Add stuff to stock, issue them and the software keeps track of numbers, costs, etc.
- Also manages multiple suppliers, warehouses, etc. So you know whom you buy certain things with and where they're stored.
- Also has a vehicle mileage tracker (originally meant to track school bus mileages). Add refueling data and it'll show you what mileage you're getting with nice graphs about how your mileage and fuel consumption has been varying.
- Different user-levels.
- Different customer types (with varying profit margins for each). 
- Produces numerous reports about how you're doing, what a particular customer has been buying, how the purchase of a certain product going, etc.

Usage
-----
Like said above, unless you're using it for a school, might need some tweaking. Just install it and see what needs to be changed. I cannot implement them for you but will answer any question you might have about the current code if you email me.

- Extract everything.
- Create a database using the SQL dump provided. The dump provided has some sample data in it. Use them to explore the system. You can empty them after installation as well. Also make sure to add a user while importing the dump.
- Update ./application_fa93g/config/database.php to the correct host, DB name, user and password. You might also have to update the table prefix if you've changed them in the database.

Thanks
-----
- EllisLab / CodeIgniter: http://ellislab.com/codeigniter
- Tank Auth for the authentication library: http://konyukhov.com/soft/tank_auth/
- GUMP for the input validation library: https://github.com/Wixel/GUMP/
