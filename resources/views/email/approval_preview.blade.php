<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Approval Request</title>
    <!--[if mso]>
    <style type="text/css">
        body, div {font-family: Arial, sans-serif !important;}
    </style>
    <![endif]-->
</head>
<body style="margin: 0; padding: 0; background-color: #ffffff; font-family: 'Monument Grotesk', -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;">
    <!-- Main Container -->
    <div style="max-width: 640px; margin: 0 auto; background-color: #ffffff;">
        
        <!-- Header with Dark Background and Texture -->
        <div style="position: relative; background-color: #141414; padding-bottom: 50px;">
            <!-- Background Texture Overlay -->
            <div style=" width: 100%; ">
            
            <!-- Header Content -->
            <div style="position: relative; z-index: 1;">
                <!-- Logo Row -->
               <div style="padding: 28px 23px 0 23px;  ">
                    <!-- Government Logo Placeholder -->
                    <div style="display: inline-block; vertical-align: middle; float: left;">
                        <img src="https://dashboard.dcd.org.ae/client/img/dcd_logo.png" style="max-height:50px; width: 150px;" />

                    </div>
                    
                    <!-- DCD Logo (SVG embedded) -->
                    <div style="display: inline-block; vertical-align: middle; text-align: right; float: right; margin-left: 20px;">
                         <img src="https://dashboard.dcd.org.ae/uploads/settings/dcd%20logog68ef3e59894ca.png" style="max-height:50px; width: 150px;" />

                    </div>
                    <div style="clear: both;"></div>
                  </div>
                
                <!-- Divider Line -->
                <div style="padding: 20px 23px 0 23px;">
                    <div style="border-bottom: 1px solid #3B3B3B; width: 100%;"></div>
                </div>
                
                <!-- Main Title -->
                <div style="padding: 37px 24px 0 24px;">
                    <h1 style="margin: 0; padding: 0; font-family: 'Monument Grotesk', Arial, sans-serif; font-size: 35px; line-height: 54px; color: #ffffff; letter-spacing: 0.35px; font-weight: normal;">
                        Content Approval Request For<br>
                        {{ $title }}
                    </h1>
                </div>
                
                <!-- Subtitle -->
                <div style="padding: 20px 21px 0 21px;">
                    <p style="margin: 0; padding: 0; font-family: 'Monument Grotesk', Arial, sans-serif; font-size: 20px; line-height: 20px; color: #9b9b9b; letter-spacing: 0.2px; font-weight: normal;">
                        Please review the following content before publishing
                    </p>
                </div>
                
                <!-- Preview Button -->
                <div style="padding: 20px 21px 0 21px;">

                @if ($modelName == "News")
                    <a href="https://dcd.org.ae/{{ $type }}/news/{{ $slug }}" target="_blank" style="display: inline-block; padding: 14px 63px; background-color: transparent; border: 1px solid #6f6f6f; border-radius: 3px; color: #faf7ee; font-family: 'Monument Grotesk', Arial, sans-serif; font-size: 14px; text-decoration: none; text-transform: capitalize; line-height: 13px; letter-spacing: 0;">
                        Preview the content
                    </a>
                @else
                     <a href="https://dcd.org.ae/{{ $type }}/events/{{ $slug }}" target="_blank"  style="display: inline-block; padding: 14px 63px; background-color: transparent; border: 1px solid #6f6f6f; border-radius: 3px; color: #faf7ee; font-family: 'Monument Grotesk', Arial, sans-serif; font-size: 14px; text-decoration: none; text-transform: capitalize; line-height: 13px; letter-spacing: 0;">
                        Preview the content
                    </a>
                 @endif

                </div>
            </div>

             </div>
        </div>
        
        <!-- White Content Section -->
        <div style="background-color: #ffffff; padding: 55px 74px 50px 74px;">
            <!-- Action Required Title -->
            <div style="padding-bottom: 5px;">
                <h2 style="margin: 0; padding: 0; font-family: 'Monument Grotesk', Arial, sans-serif; font-size: 30px; line-height: 30px; color: #191919; letter-spacing: 0.3px; font-weight: normal;">
                    Action Required
                </h2>
            </div>
            
            <!-- Description Text -->
            <div style="padding-bottom: 30px;">
                <p style="margin: 0; padding: 0; font-family: 'Monument Grotesk', Arial, sans-serif; font-size: 20px; line-height: 30px; color: #191919; letter-spacing: 0.2px; font-weight: normal;">
                    Please review the content carefully. Once you're ready, take action by either approving or rejecting the content for publication.
                </p>
            </div>
            
          <div>
            <a href="{{ route('approval.submit', ['id' => encrypt($approval_id)]) }}?status=approve&model={{ $modelName }}"
               style="width:200px; display:block; float:left; padding:14px; background-color:#191919;
                     border-radius:3px; color:#ffffff; font-family:'Monument Grotesk', Arial, sans-serif;
                     font-size:14px; text-decoration:none; text-transform:capitalize; line-height:10px;
                     letter-spacing:0; text-align:center;">
               Approve
            </a>
                        
            <a href="{{ route('approval.submit', ['id' => encrypt($approval_id)]) }}?status=reject&model={{ $modelName }}"
               style="width:200px; display:block; float:right; padding:14px; background-color:transparent;
                     border:1px solid #323232; border-radius:3px; color:#191919;
                     font-family:'Monument Grotesk', Arial, sans-serif; font-size:14px;
                     text-decoration:none; text-transform:capitalize; line-height:10px;
                     letter-spacing:0; text-align:center;">
               Reject
            </a>

            <div style="clear:both;"></div>
         </div>

        </div>
        
        <!-- Footer -->
        <div style="background-color: #141414; padding: 28px 0; text-align: center;">
            <p style="margin: 0; padding: 0; font-family: 'Monument Grotesk', Arial, sans-serif; font-size: 14px; line-height: 14px; color: #8f8f8f; letter-spacing: 0.14px; font-weight: normal;">
                www.dcd.org.ae
            </p>
        </div>
    </div>
</body>
</html>
