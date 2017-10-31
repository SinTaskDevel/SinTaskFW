<?php

	/* For General Page Blocker
	 */
	
	/** [ MAINTENANCE & DB CONFIG CONDITION ]
     * THIS PAGE RUN NON-SPA WEB-BASED
     * die() FUNCTION WILL BLOCK THE NEXT CODE
     */
    if(MAINTENANCE == true) {
        ?>
        <script>
            document.title = "Maintenance";
        </script>
        <?php 
        require($__DOC_ROOT__.$requirePath['error']."/maintenance.php");
        ?>
        </BODY></HTML>
        <?php
        die();
    }

    /** [ MAINTENANCE & DB CONFIG CONDITION ]
     * THIS PAGE RUN NON-SPA WEB-BASED
     * die() FUNCTION WILL BLOCK THE NEXT CODE
     */
    if($__CONNECT_STATUS__ == false) {
        ?>
        <script>
            document.title = "DB Conn Failed";
        </script>
        <?php 
        echo "DB Connection Failed - Check your DB settings.";
        ?>
        </BODY></HTML>
        <?php
        die();
    }

?>