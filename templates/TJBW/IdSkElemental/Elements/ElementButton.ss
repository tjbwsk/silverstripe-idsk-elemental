<% with $Action %>
	<% if $Me %>
		<% if $Up.RemoveComponentBottomMargin %>
			<% include Rasstislav/IdSk/Includes/Components/Button Title=$Title, Link=$LinkURL, TargetBlank=$OpenInNewWindow, StartButton=Up.StartButton, Variant=$Up.Variant, ExtraClass='govuk-!-margin-bottom-0' %>
		<% else %>
			<% include Rasstislav/IdSk/Includes/Components/Button Title=$Title, Link=$LinkURL, TargetBlank=$OpenInNewWindow, StartButton=Up.StartButton, Variant=$Up.Variant, ExtraClass='govuk-!-margin-bottom-6' %>
		<% end_if %>
	<% end_if %>
<% end_with %>
