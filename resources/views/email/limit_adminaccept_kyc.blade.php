@include('email.header')
<tr><td colspan='3' align='center' height='20' style='padding:0px;'></td></tr>

<tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Dear {{ $username }},</td><td align='left	'>&nbsp;</td></tr>
<tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Your {{ $name }} Accepted successfully. Please Login and continue to deposit and withdraw</td><td align='left'>&nbsp;</td></tr>
<tr><td colspan='3' align='center' height='1' style='padding:0px;'></td></tr>
@include('email.footer')
