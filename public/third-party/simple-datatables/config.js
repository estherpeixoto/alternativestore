let dataTable = new simpleDatatables.DataTable("#table", {
	sortable: true,
	searchable: true,
	customAddButton: true,
	paging: true,
	perPage: 10,
	perPageSelect: [5, 10, 15, 20, 25],
	nextPrev: true,
	firstLast: false,
	prevText: "&lsaquo;",
	nextText: "&rsaquo;",
	firstText: "&laquo;",
	lastText: "&raquo;",
	ellipsisText: "&hellip;",
	ascText: "▴",
	descText: "▾",
	truncatePager: true,
	pagerDelta: 2,
	scrollY: "",
	fixedColumns: true,
	fixedHeight: false,
	header: true,
	hiddenHeader: false,
	footer: false,
	labels: {
		placeholder: "Pesquisar...",
		perPage: "<span class='mr-3 text-sm text-gray-400'>Resultados:</span>{select}",
		noRows: "Nenhum registro encontrado",
		info: "Exibindo de {start} até {end} de {rows} registros"
	},
	layout: {
		top: "{select}{search}{customAddButton}",
		bottom: "{pager}"
	}
})