<% include TJBW/IdSkElemental/Includes/ElementTitle %>
<% if $Content %><div class="govuk-body">$Content</div><% end_if %>
<% if $PostsList %>
	<div class="row">
		<% loop $PostsList %>
			<% include SilverStripe/Blog/PostSummary %>
		<% end_loop %>
		<% if $Blog %>
			<a href="$Blog.Link" data-module="govuk-button" role="button" title="Prejdite na stránku $Blog.Title" class="idsk-button govuk-!-margin-bottom-0">Zobraziť všetky príspevky</a>
		<% end_if %>
	</div>
<% else %>
    <p class="govuk-body"><%t SilverStripe\\Blog\\Model\\Blog.NoPosts 'There are no posts' %></p>
<% end_if %>
