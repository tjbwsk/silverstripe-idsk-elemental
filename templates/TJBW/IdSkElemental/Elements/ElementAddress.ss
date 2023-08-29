<% include TJBW/IdSkElemental/Includes/ElementTitle %>
<div class="govuk-clearfix">
	<div data-module="idsk-address" class="idsk-address<% if $Variant %> $Variant<% end_if %>">
		<hr class="idsk-address__separator-top">
		<div class="idsk-address__content">
			<div class="idsk-address__description">
				<% if $PrimaryTitle %><h2 class="govuk-heading-m">$PrimaryTitle</h2><% end_if %>
				<% if $SecondaryTitle %><h3 class="govuk-heading-s">$SecondaryTitle</h3><% end_if %>
				<div class="govuk-body">
					$Content
				</div>
			</div>
			<iframe
				class="idsk-address__map govuk-!-margin-bottom-0"
				loading="lazy"
				allowfullscreen
				src="$URL"
			></iframe>
		</div>
	</div>
</div>
