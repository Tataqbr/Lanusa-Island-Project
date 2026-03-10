<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Acquisition Confirmed | Lanusa Island</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f8f9fa; font-family: 'Segoe UI', Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f8f9fa;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table width="600" border="0" cellspacing="0" cellpadding="0" style="background-color: #ffffff; border-top: 4px solid #C5A059; box-shadow: 0 20px 40px rgba(0,0,0,0.05);">
                    
                    <tr>
                        <td align="center" style="padding: 40px 0 20px 0; background-color: #0F172A;">
                            <img src="{{ asset('assets/logo.png') }}" alt="Lanusa Island" style="width: 140px; height: auto; display: block;">
                            <div style="margin-top: 15px; color: #C5A059; font-size: 10px; letter-spacing: 5px; text-transform: uppercase; font-weight: bold;">
                                Private Ecosystem
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="padding: 50px 50px 30px 50px; color: #1E293B; line-height: 1.8;">
                            <h5 style="margin: 0 0 10px; font-size: 10px; color: #C5A059; letter-spacing: 3px; text-transform: uppercase; font-weight: 900;">Acquisition Success</h5>
                            <h1 style="margin: 0 0 25px; font-size: 28px; color: #0F172A; font-weight: normal; font-family: 'Georgia', serif; font-style: italic;">
                                Welcome to the Ecosystem, {{ $data->name }}.
                            </h1>
                            
                            <p style="margin: 0 0 20px; font-size: 14px; color: #475569;">
                                We are pleased to confirm that your institutional acquisition for <strong>Lanusa Island Membership</strong> has been successfully verified. You are now part of an exclusive circle with full access to our private retreats.
                            </p>
                            
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #F8FAFC; border: 1px solid #E2E8F0; margin: 30px 0;">
                                <tr>
                                    <td style="padding: 30px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="padding-bottom: 15px; border-bottom: 1px solid #E2E8F0;">
                                                    <span style="font-size: 10px; color: #94A3B8; text-transform: uppercase; letter-spacing: 1px;">Selected Tier</span><br>
                                                    <span style="font-size: 16px; color: #0F172A; font-weight: bold;">{{ $data->plan_name }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 15px 0; border-bottom: 1px solid #E2E8F0;">
                                                    <span style="font-size: 10px; color: #94A3B8; text-transform: uppercase; letter-spacing: 1px;">Transaction Ref</span><br>
                                                    <span style="font-size: 13px; color: #0F172A; font-family: monospace;">#{{ $data->transaction_id }}</span>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <div style="margin-top: 25px; padding: 20px; background-color: #0F172A; text-align: center;">
                                            <p style="margin: 0 0 8px; font-size: 10px; color: #C5A059; text-transform: uppercase; letter-spacing: 2px;">Your Private Access Code</p>
                                            <span style="font-size: 32px; font-weight: bold; color: #ffffff; letter-spacing: 6px; font-family: 'Courier New', Courier, monospace;">{{ $data->access_code }}</span>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 0 0 10px; font-size: 13px; color: #475569;">
                                <strong>How to Initialize:</strong><br>
                                Use the code above during your next reservation on our portal to unlock institutional rates and priority concierge services.
                            </p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="padding: 0 50px 50px 50px;">
                            <div style="height: 1px; background-color: #E2E8F0; width: 100%; margin-bottom: 30px;"></div>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="font-size: 12px; color: #94A3B8; line-height: 1.5;">
                                        Best Regards,<br>
                                        <strong style="color: #0F172A;">Lanusa Management Team</strong><br>
                                        <span style="font-size: 11px;">Institutional Relations Division</span>
                                    </td>
                                    <td align="right">
                                        <a href="https://lanusa-island.com/" style="font-size: 11px; color: #C5A059; text-decoration: none; font-weight: bold; border: 1px solid #C5A059; padding: 8px 15px;">VISIT PORTAL</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding: 20px; background-color: #F1F5F9; color: #94A3B8; font-size: 10px; letter-spacing: 1px; text-transform: uppercase;">
                            &copy; {{ date('Y') }} Lanusa Island Resorts & Partnerships.
                        </td>
                    </tr>
                </table>
                
                <p style="margin-top: 20px; font-size: 10px; color: #cbd5e1; text-align: center; max-width: 600px;">
                    This is an automated institutional message. Please do not share your Access Code with third parties. 
                    If you did not authorize this transaction, contact security@lanusa-island.com immediately.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>