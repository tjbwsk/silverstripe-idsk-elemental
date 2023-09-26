<% with $TopPage %>
	<% if $FeaturedImage %>
		<% if $Up.RemoveComponentBottomMargin %>
			$FeaturedImage.ScaleMaxWidth(720).setAttribute('aria-hidden', 'true').setAttribute('class', 'img-fluid')
		<% else %>
			$FeaturedImage.ScaleMaxWidth(720).setAttribute('aria-hidden', 'true').setAttribute('class', 'img-fluid govuk-!-margin-bottom-6')
		<% end_if %>
	<% end_if %>
<% end_with %>
