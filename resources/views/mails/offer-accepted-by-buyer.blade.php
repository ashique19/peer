@extends('mails.partials.layout')
@section('main')

<!-- MODULE ROW // -->
<!--
	To move or duplicate any of the design patterns
	in this email, simply move or copy the entire
	MODULE ROW section for each content block.
-->
<tr>
	<td align="center" valign="top">
		<!-- CENTERING TABLE // -->
		<!--
			The centering table keeps the content
			tables centered in the emailBody table,
			in case its width is set to 100%.
		-->
		<table border="0" cellpadding="0" cellspacing="0" width="100%" style="color:#FFFFFF;" bgcolor="#0080c5">
			<tr>
				<td align="center" valign="top">
					<!-- FLEXIBLE CONTAINER // -->
					<!--
						The flexible container has a set width
						that gets overridden by the media query.
						Most content tables within can then be
						given 100% widths.
					-->
					<table border="0" cellpadding="0" cellspacing="0" width="500" class="flexibleContainer">
						<tr>
							<td align="center" valign="top" width="500" class="flexibleContainerCell">

								<!-- CONTENT TABLE // -->
								<!--
								The content table is the first element
									that's entirely separate from the structural
									framework of the email.
								-->
								<table border="0" cellpadding="30" cellspacing="0" width="100%">
									<tr>
										<td align="center" valign="top" class="textContent">
											<h1 style="color:#FFFFFF;line-height:100%;font-family:Helvetica,Arial,sans-serif;font-size:35px;font-weight:normal;margin-bottom:5px;text-align:center;">Congratulations on Accepting the Offer.</h1>
											<h2 style="color:#FFFFFF;line-height:100%;font-family:Helvetica,Arial,sans-serif;font-size:35px;font-weight:normal;margin-bottom:5px;text-align:center;">Please Pay now for the product and we will notify your traveler to buy the product.</h2>
										</td>
									</tr>
								</table>
								<!-- // CONTENT TABLE -->

							</td>
						</tr>
					</table>
					<!-- // FLEXIBLE CONTAINER -->
				</td>
			</tr>
		</table>
		<!-- // CENTERING TABLE -->
	</td>
</tr>
<!-- // MODULE ROW -->


<!-- MODULE ROW // -->
<tr>
	<td align="center" valign="top">
		<!-- CENTERING TABLE // -->
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr style="padding-top:0;">
				<td align="center" valign="top">
					<!-- FLEXIBLE CONTAINER // -->
					<table border="0" cellpadding="30" cellspacing="0" width="500" class="flexibleContainer">
						
						
						<tr>
							<td style="padding-top:0;" align="center" valign="top" width="500" class="flexibleContainerCell">

								<!-- CONTENT TABLE // -->
								<table border="0" cellpadding="0" cellspacing="0" width="100%" class="emailButton" style="background-color: white;">
									<tr>
										<td align="center" valign="middle" class="buttonContent" style="padding-top:15px;padding-bottom:15px;padding-right:15px;padding-left:15px;color:#666666; text-align:left; font-size: 14px;">
											<p>We will hold your money in our escrow until your traveler delivers you the product. It is completely Safe & Secured.</p>
											<p>We are as excited as you, for your new purchase!</p>
											<p>Follow the link below to make the payment</p>
										</td>
									</tr>
								</table>
								<!-- // CONTENT TABLE -->

							</td>
						</tr>
						
						<tr>
							<td style="padding-top:0;" align="center" valign="top" width="500" class="flexibleContainerCell">

								<!-- CONTENT TABLE // -->
								<table border="0" cellpadding="0" cellspacing="0" width="50%" class="emailButton" style="background-color: #3498DB;">
									<tr>
										<td align="center" valign="middle" class="buttonContent" style="padding-top:15px;padding-bottom:15px;padding-right:15px;padding-left:15px;">
											<a style="color:#FFFFFF;text-decoration:none;font-family:Helvetica,Arial,sans-serif;font-size:20px;line-height:135%;" href="{{action('Offers@offerFromBuyerAccepted')}}" target="_blank">Click to pay.</a>
											<br>
											<p>Thank you for using Airposted.</p>
										</td>
									</tr>
								</table>
								<!-- // CONTENT TABLE -->

							</td>
						</tr>
						
					</table>
					<!-- // FLEXIBLE CONTAINER -->
				</td>
			</tr>
		</table>
		<!-- // CENTERING TABLE -->
	</td>
</tr>
<!-- // MODULE ROW -->

@stop