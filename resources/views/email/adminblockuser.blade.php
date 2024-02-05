@include('email.header')
<tr><td colspan='3' align='center' height='20' style='padding:0px;'></td></tr>
<tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Dear {{ $useralldata->name }},</td><td align='left'>&nbsp;</td></tr>

@if(!empty($useralldata->reason))
<tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>
Your account has been blocked for the reason {{ $useralldata->reason }}.Kindly contact admin for account unblock</td><td align='left'>&nbsp;</td></tr>
@else
<tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Your account has been blocked. Kindly contact admin for account unblock</td><td align='left'>&nbsp;</td></tr>

@endif

<tr><td colspan='3' align='center' height='1' style='padding:0px;'></td></tr>
@include('email.footer')


