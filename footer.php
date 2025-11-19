    </div>
    
    <?php wp_footer(); ?>
    
    <style>
        /* Accessibilité - Skip link */
        .skip-link {
            position: absolute;
            left: -9999px;
            z-index: 999999;
            padding: 8px 16px;
            background: #000;
            color: #fff;
            text-decoration: none;
        }
        
        .skip-link:focus {
            left: 6px;
            top: 7px;
        }
        
        .screen-reader-text {
            clip: rect(1px, 1px, 1px, 1px);
            position: absolute !important;
            height: 1px;
            width: 1px;
            overflow: hidden;
            word-wrap: normal !important;
        }
        
        .screen-reader-text:focus {
            clip: auto !important;
            height: auto;
            width: auto;
            display: block;
            font-size: 1em;
            font-weight: bold;
            padding: 15px 23px 14px;
            color: #fff;
            background: #000;
            z-index: 100000;
            text-decoration: none;
            box-shadow: 0 0 2px 2px rgba(0,0,0,.6);
        }
    </style>
</body>
</html>
