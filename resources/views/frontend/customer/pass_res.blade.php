
<html>
    <head>
      <title></title>
      <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700& display=swap" rel="stylesheet">
  
    <style> 

    body{
        background: #e5e5e5;
    }
    * {
      font-family: "Inter", sans-serif;
    }

    #table-container {
      width: 648px;
      border-collaps: collapse;
      border: 0;
      border-spacing: 0;
      background: #fff;
    }
    #table-container #table-content {
        padding: 2.5rem;
    }
    
    @media screen and (max-width: 640px) {
      #table-container {
        width: 100%;
      }
      #table-container #table-content {
        padding: 1rem .4rem;
    }
       #footer > td {
       padding: 2rem 1.2rem 1.2rem 1.2rem !important;
      }
    }
    </style>
    </head>
    <body>
    <table role="presentation" cellpadding="0" border="0" align="center" id="table-container">
 <tr>
   <td id="table-content">
      <table style="width: 100%">
     <tr>
     <td style="border-bottom: 0.4px solid #E0E0E0; width: 100%; padding-bottom: 1.5rem;">
  <img src="https://i.ibb.co/BcxCysx/nike.png" alt="" width="100px" />
     </td>
   </tr>
        <tr>
           <td>
             <p style="font-size: 24px; color: #4F4F4F; font-weight:  600; margin-top: 30px;"><b> Password Reset </b></p>
       <p style="color: #828282; font-size: 14px; font-weight: 400;">Hello Blessing,</p>
       <p style="color: #828282; font-size: 14px; line-height: 2.0; font-weight: 400;">It looks like you’ve made a password reset request. Please click the button below
to reset your password.</p>
             <a href="{{route('pass.reset.form', $token)}}">
               <button style="width: 100%; height: 50px; border: none; background: #F5A623; font-size: 14px; color: #fff; border-radius: 4px; cursor: pointer; margin-bottom: 1rem;"> Reset Password </button>
             </a>
             <p style="font-size: 14px; color: #828282; line-height: 1.5;">Need help?  <a href="#contact" style="color: #F5A623; text-decoration: none;"> Contact us </a> right away.</p>
     </td>
        </tr>
  </table>
   </td>
 </tr>
<!--    -->
<tr id="footer">
    <td style="max-width: 100%; height: auto; border-bottom: 6px solid #F5A623; background: #FFF2DD; padding: 2rem 3.5rem 1.3rem 3.5rem; margin-bottom: 30px;">
      <img src="https://i.ibb.co/BcxCysx/nike.png" alt="" width="100px" style="margin: auto; display: block;" />
      <p style="font-size: 12px; color: #4F4F4F; text-align: center; line-height: 1.5; margin: 1rem 0;">Copyrights 2021 Flutterwave Technologies - All Rights Reserved.</p>
      
      <center>
      <section id="socials" style="display: inline-flex;">
        <a href="#/twitter">
          <span class="tw" style="width: 40px; height: 40px; background: #FEEBCA; border-radius: 30px; display: flex;">
            <img src="https://res.cloudinary.com/joshuaolajide/image/upload/v1623330533/twitter_q1k1lj.png" alt="twitter-icon" style="margin: auto;"/>
          </span>
        </a>
        <a href="#">
          <span class="in" style="width: 40px; height: 40px; background: #FEEBCA; border-radius: 30px; display: flex; margin-left: 10px; margin-right: 10px;">
            <img src="https://res.cloudinary.com/joshuaolajide/image/upload/v1623330552/IG_rpohc9.png" alt="instagram-icon" style="margin: auto;" />
          </span>
        </a>
        <a href="#">
          <span class="fb" style="width: 40px; height: 40px; background: #FEEBCA; border-radius: 30px; display: flex;">
            <img src="https://res.cloudinary.com/joshuaolajide/image/upload/v1630337535/facebook_hv4itd.png" alt="facebook-icon" style="margin: auto;"/>
          </span>
        </a>
      </section>
      </center>


      <section id="footer-bottom" style="width: 100%; border-top: 0.4px solid #F5A623; margin-top: 20px; padding-top: 1rem;">
        <p style="text-align: center; color: #4F4F4F; font-size: 12px; line-height: 1.6"> hi@flutterwavego.com | 0700-FLUTTERWAVE</p>
        <p style="text-align: center; font-size: 12px;">
          <a href="#" style="text-align: center; color: #4F4F4F; text-decoration: underline;">Unsubscribe me</a>
        </p>
      </section>

    </td>
  </tr>
  
</table>
    </body>
  </html>
