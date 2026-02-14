<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // login
    $ldapServer = 'ldap://10.184.82.55';
    $ldapPort   = 389;

    $ldapConn = ldap_connect($ldapServer, $ldapPort);

    ldap_set_option($ldapConn, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldapConn, LDAP_OPT_REFERRALS, 0);

    if (!$ldapConn) {
        die('Unable to connect to LDAP server.');
    }

    // dn and password of the administrator
    $ldapBindUser     = 'cn=admin,dc=ldapinjection,dc=com';
    $ldapBindPassword = 'admin';

    $ldapBind = ldap_bind($ldapConn, $ldapBindUser, $ldapBindPassword);

    if (!$ldapBind) {
        die('LDAP authentication failed.');
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $ldapSearchBase = 'ou=people,dc=ldapinjection,dc=com';

    // Search filter
    // $ldapSearchFilter = "(&(uid=$username)(userPassword=$password))";

    // Secure Search Filter
    // Escape special characters for the LDAP filter

    $ldapSearchFilter = "(&(uid=" . ldap_escape($username, "", LDAP_ESCAPE_FILTER) . ")" .
                    "(userPassword=" . ldap_escape($password, "", LDAP_ESCAPE_FILTER) . "))";

  
    // User search
    $ldapResult = ldap_search($ldapConn, $ldapSearchBase, $ldapSearchFilter);

    if ($ldapResult === false) {
        die('LDAP search failed.');
    }

    // retrieve entry
    $entries = ldap_get_entries($ldapConn, $ldapResult);

    if ($entries['count']) {

        $userDn = $entries[0]['dn'];

        // if (ldap_bind($ldapConn, $userDn, $password))
        if ($userDn = $entries[0]['dn']) {

            // Authentication successful
            echo "<br>";
            echo 'Authentication successful for user: ' . $username;
            echo "<br>";
            echo "<br>";

            $ii = 0;

            for ($i = 0; $ii < $entries[$i]["count"]; $ii++) {

                $data = $entries[$i][$ii];

                echo $data . ": " . $entries[$i][$data][0] . "<br>";
            }

        } else {

            echo 'Incorrect password.';

        }

    } else {

        echo 'User not found.';

    }

    // Close the LDAP connection
    ldap_close($ldapConn);
}

?>


git remote add origin https://github.com/JanieAbutu/Software_Application-Security-Projects