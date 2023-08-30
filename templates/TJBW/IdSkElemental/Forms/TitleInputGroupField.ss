<div class="input-group">
	<% with $FieldList.dataFieldByName('TitleTag') %>
		<% if $Me %>
			<div class="input-group-prepend">
				<span class="input-group-text p-0">
					$Me
				</span>
			</div>
		<% end_if %>
	<% end_with %>
	$FieldList.dataFieldByName('Title')
	<% if $FieldList.dataFieldByName('TitleClass') || $FieldList.dataFieldByName('ShowTitle') %>
		<div class="input-group-append">
			<% with $FieldList.dataFieldByName('TitleClass') %>
				<% if $Me %>
					<span class="input-group-text p-0">
						$Me
					</span>
				<% end_if %>
			<% end_with %>
			<% with $FieldList.dataFieldByName('ShowTitle') %>
				<% if $Me %>
					<span class="input-group-text position-relative">
						$Me
						<% if $Title %><label for="$ID" class="form-check-label stretched-link">$Title</label><% end_if %>
					</span>
				<% end_if %>
			<% end_with %>
		</div>
	<% end_if %>
</div>
