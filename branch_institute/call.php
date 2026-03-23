<div class="call">
    <button class="call-button" id="callBtn"><i class="fa fa-phone" style="color: blue;"></i> CALL</button>

    <script>
        document.getElementById('callBtn').addEventListener('click', function() {
            window.location.href = 'tel:<?php echo $brand_call_no?>'; 
        });
    </script>
</div>

       <style>
          
            .call-button {
            display: inline-block;
            color: #000000;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            border: none;
            background-color: #d8f4fd;
        }
        
        /* Media query for small screens */
        @media (max-width: 600px) {
            .call-button {
                padding: 8px 10px;
                font-size: 14px;
                /*background-color: #0056b3; */
            }
        }
        
        /* Media query for larger screens */
        @media (min-width: 601px) and (max-width: 1200px) {
            .call-button {
                /padding: 8px 10px;/
                font-size: 18px;
                /*background-color: #007bff;  */
            }
        }
        
        /* Media query for extra-large screens */
        @media (min-width: 1201px) {
            .call-button {
                /padding: 8px 30px;/
                font-size: 17px;
                /*background-color: #004085; */
            }
        }  
        
        /*.call {*/
        /*    position: fixed;*/
        /*    margin: 595px;*/
        /*    z-index: 10000000;*/
        /*    font-family: "Avenir Next", serif;*/
        /*    font-weight: 700;*/
        /*    top: auto;*/
        /*    right: -574px;*/
        /*    background: #ffffff;*/
        /*    border-radius: 30px;*/
        /*    padding: 10px;*/
        /*    display: flex;*/
        /*    flex-direction: column;*/
        /*    align-items: center;*/
        /*    justify-content: space-between;*/
        /*    min-height: 30px;*/
        /*    height: auto;*/
        /*    max-width: 100px;*/
        /*    width: 100%;*/
        /*    box-sizing: border-box;*/
        /*    box-shadow: 0px 1px 20px 0px rgb(0 0 0 / 10%);*/
        /*}*/
        
        .call {
            margin: 0 72px 100px 0 !important;
            padding: 10px;
            position: fixed !important;
            z-index: 16000160 !important;
            bottom: 0 !important;
            text-align: center !important;
            height: 50px;
            min-width: 50px;
            border-radius: 25px;
            visibility: visible;
            transition: none !important;
            background: #d8f4fd;
            box-shadow: 1px 1px 20px 0px rgb(0 0 0 / 55%);
            right: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
                }


        </style>