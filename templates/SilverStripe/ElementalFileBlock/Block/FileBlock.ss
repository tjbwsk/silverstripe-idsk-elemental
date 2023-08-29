<% if $Title && $ShowTitle %>
	<figure class="govuk-!-margin-0">
		$File.FitMax(1920, 1080).setAttribute('class', 'img-fluid')
		<figcaption class="govuk-body-s govuk-!-margin-bottom-0">$Title</figcaption>
	</figure>
<% else %>
	$File.FitMax(1920, 1080).setAttribute('class', 'img-fluid')
<% end_if %>
