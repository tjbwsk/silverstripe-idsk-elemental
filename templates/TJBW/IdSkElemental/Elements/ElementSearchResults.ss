<div class="govuk-grid-row">
	<div class="govuk-grid-column-full idsk-search-results__search-bar idsk-search-results--visible__mobile--inline">
		$TopSearchForm
	</div>
	<div class="idsk-search-results__content">
		<div class="govuk-grid-column-one-quarter">
			<span class="idsk-search-results__content__number-of-results govuk-!-margin-bottom-2"><%t TJBW\\IdSkElemental\\Elements\\ElementSearchResults.RESULTS_COUNT '{count} result|{count} results' count=$Results.Count %></span>
		</div>
		<div class="govuk-grid-column-two-quarters idsk-search-results__filter-panel--mobile govuk-clearfix govuk-!-padding-0"></div>
		<div class="idsk-search-results--order">
			<div class="govuk-form-group">
				<%t TJBW\\IdSkElemental\\Elements\\ElementSearchResults.RESULTS_COUNT '{count} result|{count} results' count=$Results.Count %>
			</div>
		</div>
		<div class="idsk-search-results__content__picked-filters govuk-grid-column-full idsk-search-results--invisible__mobile"></div>
		<div class="govuk-grid-column-full idsk-search-results__show-results__button idsk-search-results--invisible">
			<button class="govuk-button idsk-search-results__button-show-results" type="button"><%t TJBW\\IdSkElemental\\Elements\\ElementSearchResults.SHOW_RESULTS_COUNT 'Show {count} result|Show {count} results' count=$Results.Count %></button>
		</div>
		<div class="idsk-search-results__content__all">
			<% if $Results %>
				<% loop $Results %>
					<div class="idsk-search-results__card govuk-grid-column-full govuk-!-margin-top-2">
						<div class="idsk-card-basic-variant">
							<div class="idsk-card-content idsk-card-content-basic-variant">
								<div class="idsk-heading idsk-heading-basic-variant govuk-!-padding-bottom-0">
									<a href="$Link" class="idsk-card-title govuk-link" title="Lorem ipsum dolor sit amet, consectetur adipiscing">$Title</a>
								</div>
							</div>
						</div>
					</div>
				<% end_loop %>
			<% else %>
				<div class="idsk-search-results__card govuk-grid-column-full govuk-!-margin-top-2">
					<div class="idsk-card-basic-variant">
						<div class="idsk-card-content idsk-card-content-basic-variant">
							<p class="idsk-body idsk-body-basic-variant govuk-!-margin-top-2">
								<%t TJBW\\IdSkElemental\\Elements\\ElementSearchResults.NO_RESULTS 'Sorry, your search query did not return any results.' %>
							</p>
						</div>
					</div>
				</div>
			<% end_if %>
		</div>
		<% with $Results %>
			<% if $MoreThanOnePage %>
				<div class="govuk-grid-column-two-quarters idsk-search-results__filter-panel--mobile govuk-clearfix govuk-!-padding-0 govuk-!-margin-top-2"></div>
				<div class="idsk-search-results__content__picked-filters govuk-grid-column-full idsk-search-results--invisible__mobile govuk-!-margin-top-2"></div>
				<div class="govuk-grid-column-full govuk-!-margin-top-6">
					<% include Rasstislav/IdSk/Includes/Pagination %>
				</div>
			<% end_if %>
		<% end_with %>
	</div>
</div>
