intrasphere for clansphere 2009.0
---------------------------------

requirements:

- MUST HAVE: ClanSphere 2009.0 RC 3 or newer installed and sql-updates up to date

- 2009.0 RC 2 and earlier versions are not supported and won't be in future, please consider upgrading


install steps:

1. upload content to your clansphere installation except for this file and intrasphere.sql + intrasphere_uninstall.sql

2. run "intrasphere.sql" in database -> import and empty the cache if needed

3. set access level of the new five mods for all access entries to 2 or for admins to 5

4. when you get cs_html_* fatal errors in php then switch to xhtml_10_old.php in system/core/functions.php

5. have fun testing it, there shouldn't be many problems since we've tested it, too

- please report any bugs you encounter and wishes


changelog:

2009.0 - updated intrasphere to be compatible with clansphere 2009.0