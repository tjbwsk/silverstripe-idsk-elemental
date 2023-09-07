<% include TJBW/IdSkElemental/Includes/ElementTitle %>
<div data-module="idsk-tabs" class="idsk-tabs<% if $RemoveComponentBottomMargin %> govuk-!-margin-bottom-0<% end_if %>">
	<ul class="idsk-tabs__list">
		<% loop $Elements.Elements %>
			<li class="idsk-tabs__list-item<% if $First %> idsk-tabs__list-item--selected<% end_if %>">
				<a href="#$Top.Page.Title.RAW2URL-$Anchor" title="$Title" item="$LoopPos(0)" class="idsk-tabs__tab">
					$Title
				</a>
			</li>
		<% end_loop %>
	</ul>
	<ul role="tablist" class="idsk-tabs__list--mobile">
		<% loop $Elements.Elements %>
			<li role="presentation" class="idsk-tabs__list-item--mobile">
				<button href="#$Top.Page.Title.RAW2URL-$Anchor" item="$LoopPos(0)" role="tab" aria-controls="$Top.Page.Title.RAW2URL-$Anchor" aria-selected="false" class="govuk-caption-l idsk-tabs__mobile-tab">
					$Title
					<span class="idsk-tabs__tab-arrow-mobile"></span>
				</button>
				<section id="$Top.Page.Title.RAW2URL-$Anchor" class="idsk-tabs__panel<% if not $First %> idsk-tabs__panel--hidden<% end_if %>">
					$Me
				</section>
			</li>
		<% end_loop %>
	</ul>
</div>
