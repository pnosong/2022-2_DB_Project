<?php
$db_information = '(DESCRIPTION =
(ADDRESS_LIST=
        (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521))
)
(CONNECT_DATA =
(SID = orcl)
)
)';
$con = oci_connect("DBA2022G3", "test1234", $db_information);
?>