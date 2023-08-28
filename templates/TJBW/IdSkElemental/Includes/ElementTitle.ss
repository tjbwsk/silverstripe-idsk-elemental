<% if $Title && $ShowTitle %>
	<% if $Caption %><span class="$CaptionSizeClass">$Caption</span><% end_if %>
	<$TitleTag class="$TitleSizeClass<% if $ExtraClass %> $ExtraClass<% end_if %>">$Title</$TitleTag>
<% end_if %>
