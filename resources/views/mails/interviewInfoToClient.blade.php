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
											<h1 style="color:#FFFFFF;line-height:100%;font-family:Helvetica,Arial,sans-serif;font-size:35px;font-weight:normal;margin-bottom:5px;text-align:center;">Interview request has been submitted to TeamSourcing (BD) team</h1>
											<h2 style="text-align:center;font-weight:normal;font-family:Helvetica,Arial,sans-serif;font-size:23px;margin-bottom:10px;color:#205478;line-height:135%;">We will take it from here.</h2>
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
					    
					    <h2 style="text-align:center; padding: 20px 0px; width:100%;">What happens on next?</h2>
					    
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
											<p><strong>Next steps-</strong></p>
											<ol>
												<li>We will communicate with you within 48 working hours.</li>
												<li>We arrange the interview for you.</li>
												<li>You select your team members.</li>
												<li>We send you cost estimation.</li>
												<li>You accept the offer.</li>
												<li>We send you invoice.</li>
												<li>We make the initial payment.</li>
												<li>We prepare the work station for you and sign up your team members.</li>
												<li>You start to work with your team.</li>
											</ol>
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