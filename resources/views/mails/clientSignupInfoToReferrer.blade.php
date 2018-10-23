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
											<h1 style="color:#FFFFFF;line-height:100%;font-family:Helvetica,Arial,sans-serif;font-size:35px;font-weight:normal;margin-bottom:5px;text-align:center;">{{$user->firstname}} {{$user->lastname}} signed up at TeamSourcing (BD)</h1>
											<h2 style="text-align:center;font-weight:normal;font-family:Helvetica,Arial,sans-serif;font-size:23px;margin-bottom:10px;color:#205478;line-height:135%;">Please activate the account.</h2>
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
<!--  The "mc:hideable" is a feature for MailChimp which allows
	you to disable certain row. It works perfectly for our row structure.
	http://kb.mailchimp.com/article/template-language-creating-editable-content-areas/
-->
<tr mc:hideable>
	<td align="center" valign="top">
		<!-- CENTERING TABLE // -->
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td align="center" valign="top">
					<!-- FLEXIBLE CONTAINER // -->
					    
					    <h2 style="text-align:center; padding: 20px 0px; width:100%;">Click on the link below to activate your client's TeamSourcing (BD) account.</h2>
					    
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
											<p><strong>Your account details</strong></p>
											<p>User id: {{$referrer->email}}</p>
										</td>
									</tr>
									
									<tr>
										<td align="center" valign="middle" class="buttonContent" style="padding-top:15px;padding-bottom:15px;padding-right:15px;padding-left:15px;color:#666666; text-align:left; font-size: 14px;">
											<p><strong>Client's details</strong></p>
											<p>User id: {{$user->email}}</p>
											<p>Name: {{$user->firstname}} {{$user->lastname}} | {{$user->business_name}}</p>
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
											<a style="color:#FFFFFF;text-decoration:none;font-family:Helvetica,Arial,sans-serif;font-size:20px;line-height:135%;" href="{{route('login')}}" target="_blank">TeamSourcing (BD) Login</a>
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