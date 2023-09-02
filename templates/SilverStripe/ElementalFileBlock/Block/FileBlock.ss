<% if $Title && $ShowTitle %>
	<figure class="govuk-!-margin-0">
		$File.FitMax(1920, 1080).setAttribute('class', 'img-fluid')
		<figcaption class="govuk-body-s<% if $RemoveComponentBottomMargin %> govuk-!-margin-bottom-0<% else %> govuk-!-margin-bottom-6<% end_if %>">$Title</figcaption>
	</figure>
<% else_if $RemoveComponentBottomMargin %>
	$File.FitMax(1920, 1080).setAttribute('class', 'img-fluid')
<% else %>
	$File.FitMax(1920, 1080).setAttribute('class', 'img-fluid govuk-!-margin-bottom-6')
<% end_if %>
