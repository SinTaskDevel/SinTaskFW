<?php

	/* Untuk General Page Blocker (Bukan SPA)
	 */
	
	/** [ MAINTENANCE & DB CONFIG ]
     *  Halaman berbasiskan Non-SPA
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

    /** [ MAINTENANCE & DB CONFIG ]
     *  Halaman berbasiskan Non-SPA
     */
    if($__CONNECT_STATUS__ == false) {
        ?>
        <script>
            document.title = "Sambungan ke DB Gagal / DB Connection Failed";
        </script>
        <style>
            body {
                font-size: 14px; 
                color: #777777; 
                font-family: Arial; 
                text-align: center;
            }
            h1 {
                font-size: 100px; 
                color: #555555; 
                background: transparent; 
                margin: 70px 0 0 0;
            }
            h2 {
                color: #FFFFFF; 
                background: #DE6C5D; 
                font-family: arial; 
                font-size: 20px; 
                font-weight: bold; 
                letter-spacing: -1px; 
                padding: 20px 0 20px;
            }
            p {
                width: 375px; 
                text-align: center; 
                margin-left: auto;
                margin-right: auto; 
                margin-top: 30px 
            }
            div {
                width: 375px; 
                text-align: center; 
                margin-left: auto;
                margin-right: auto;
                padding: 20px;
            }
            a:link      {color: #34536A;}
            a:visited   {color: #34536A;}
            a:active    {color: #34536A;}
            a:hover     {color: #34536A;}
        </style>

        <h1>Database,</h1>
        <h2>Sambungan ke basis data gagal.</h2>
        <div>
            Periksa sambungan anda dengan basis data, silahkan periksa konfigurasi dan juga pastikan server basis data berjalan.
        </div>
        </BODY></HTML>
        <?php
        die();
    }

?>