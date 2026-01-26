<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Change Notification</title>
    <!--[if mso]>
    <style type="text/css">
        body, div {font-family: Arial, sans-serif !important;}
    </style>
    <![endif]-->
</head>
<body style="margin: 0; padding: 0; background-color: #ffffff; font-family: 'Monument Grotesk', -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;">
    <!-- Main Container -->
    <div style="max-width: 640px; margin: 0 auto; background-color: #ffffff;">
        
        <!-- Header with Dark Background -->
        <div style="position: relative; background-color: #141414; padding-bottom: 50px;">
            <div style="width: 100%;">
                <div style="position: relative; z-index: 1;">

                    <!-- Logo Row -->
                    <div style="padding: 28px 23px 0 23px;">
                        <div style="display: inline-block; vertical-align: middle; float: left;">
                            <img src="https://dashboard.dcd.org.ae/client/img/dcd_logo.png" style="max-height:50px; width:150px;" alt="Government Logo">
                        </div>
                        <div style="display: inline-block; vertical-align: middle; text-align: right; float: right; margin-left: 20px;">
                            <img src="https://dashboard.dcd.org.ae/uploads/settings/dcd%20logog68ef3e59894ca.png" style="max-height:50px; width:150px;" alt="DCD Logo">
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    
                    <!-- Divider -->
                    <div style="padding: 20px 23px 0 23px;">
                        <div style="border-bottom: 1px solid #3B3B3B; width: 100%;"></div>
                    </div>
                    
                    <!-- Title -->
                    <div style="padding: 37px 24px 0 24px;">
                        <h1 style="margin: 0; padding: 0; font-size: 35px; line-height: 54px; color: #ffffff; letter-spacing: 0.35px; font-weight: normal;">
                          {{ $modelName }}  Status Changed to Draft :<br>
                            {{ $title }}
                        </h1>
                    </div>

                    <!-- Subtitle -->
                    {{-- <div style="padding: 20px 21px 0 21px;">
                        <p style="margin: 0; font-size: 20px; line-height: 20px; color: #9b9b9b;">
                            The publication status of your submitted content has been changed from Published to Draft.
                        </p>
                    </div> --}}

                    <!-- Preview Button -->
                   <div style="padding: 20px 21px 0 21px;">
                        @if ($modelName == "News")
                            <a href="https://dcd.org.ae/{{ $type.'_draft' }}/news/{{ $slug }}" target="_blank"
                               style="display:inline-block; padding:14px 63px; background-color:transparent;
                                      border:1px solid #6f6f6f; border-radius:3px; color:#faf7ee;
                                      font-family:'Monument Grotesk', Arial, sans-serif; font-size:14px;
                                      text-decoration:none; text-transform:capitalize; line-height:13px;">
                                Preview the content
                            </a>
                        @else
                            <a href="https://dcd.org.ae/{{ $type.'_draft' }}/events/{{ $slug }}" target="_blank"
                               style="display:inline-block; padding:14px 63px; background-color:transparent;
                                      border:1px solid #6f6f6f; border-radius:3px; color:#faf7ee;
                                      font-family:'Monument Grotesk', Arial, sans-serif; font-size:14px;
                                      text-decoration:none; text-transform:capitalize; line-height:13px;">
                                Preview the content
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div style="background-color: #ffffff; padding: 55px 74px 50px 74px;">

            {{-- <div style="padding-bottom: 5px;">
                 <h2 style="margin: 0; font-size: 30px; line-height: 30px; color: #141414;">
                    Status Changed 
                </h2>
            </div>
            
            <div style="padding-bottom: 30px;">
                <p style="margin: 0; font-size: 20px; line-height: 30px; color: #191919;">
                  Your content item titled “{{ $title }}” has been updated with the following status:
                </p>

                <p style="font-size: 22px; line-height: 28px; color:#0077cc; margin-top:10px;">
                    <strong>{{ ucfirst($status) }}</strong>
                </p>
            </div> --}}

            <div style="text-align: center;">
                <a href="https://dashboard.dcd.org.ae/sw-admin"
                   style="display:inline-block; padding:14px 40px; background-color:#141414; border-radius:3px; color:#ffffff; font-size:14px; text-decoration:none;">
                    View in Dashboard
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div style="background-color: #141414; padding: 28px 0; text-align: center;">
            <p style="margin: 0; font-size: 14px; line-height: 14px; color: #8f8f8f;">
                www.dcd.org.ae
            </p>
        </div>
    </div>
</body>
</html>
