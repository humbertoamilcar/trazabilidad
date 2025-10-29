/**
 * Academy Dashboard charts and datatable
 */

'use strict';

(function () {
  let labelColor, headingColor, borderColor;

  if (isDarkStyle) {
    labelColor = config.colors_dark.textMuted;
    headingColor = config.colors_dark.headingColor;
    borderColor = config.colors_dark.borderColor;
  } else {
    labelColor = config.colors.textMuted;
    headingColor = config.colors.headingColor;
    borderColor = config.colors.borderColor;
  }

  // Donut Chart Colors
  const chartColors = {
    donut: {
      series1: config.colors.danger,
      series2: config.colors.info,
      series3: config.colors.dark,
      series4: config.colors.warning,
      series5: config.colors.success,
      series6: config.colors.secondary,
    }
  };

  const leadsReportChartEl = document.querySelector('#leadsReportChart');
  const url = base_url + "Dashboard/reporteStock";

  fetch(url)
    .then(response => {
      if (!response.ok) throw new Error('HTTP error ' + response.status);
      return response.json();
    })
    .then(data => {
      if (Array.isArray(data) && data.length > 0) {
        const labels = data.map(item => item.pais || '');  
        const series = data.map(item => Number(item.total_vistas) || 0);

        const leadsReportChartConfig = {
          chart: { height: 157, width: 130, parentHeightOffset: 0, type: 'pie' },
          labels: labels,
          series: series,
          colors: [
            chartColors.donut.series1,
            chartColors.donut.series2,
            chartColors.donut.series3,
            chartColors.donut.series4,
            chartColors.donut.series5,
            chartColors.donut.series6
          ],
          stroke: { width: 0 },
          dataLabels: {
            enabled: false,
            formatter: val => parseInt(val) + '%'
          },
          legend: { show: false },
          tooltip: { theme: false },
          grid: { padding: { top: 0 } },
          plotOptions: {
            pie: {
              donut: {
                size: '75%',
                labels: {
                  show: true,
                  value: {
                    fontSize: '1.5rem',
                    fontFamily: 'Public Sans',
                    color: headingColor,
                    fontWeight: 500,
                    offsetY: -15,
                    formatter: val => parseInt(val) + 'U.'
                  },
                  name: { offsetY: 20, fontFamily: 'Public Sans' },
                  total: {
                    show: true,
                    fontSize: '.3rem',
                    label: 'Total',
                    color: labelColor,
                    formatter: w => 'Total: ' + w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                  }
                }
              }
            }
          }
        };

        if (leadsReportChartEl) {
          const leadsReportChart = new ApexCharts(leadsReportChartEl, leadsReportChartConfig);
          leadsReportChart.render();
        }
      } else {
        console.error('Los datos JSON no tienen el formato esperado.');
      }
    })
    .catch(error => console.error('Error al cargar los datos:', error));

  // Horizontal Bar Chart
  const horizontalBarChartEl = document.querySelector('#horizontalBarChart');
  const requestUrl = base_url + "Dashboard/reporteVendidos";

  const horizontalBarChartConfig = {
    chart: { height: 370, type: 'bar', toolbar: { show: false } },
    plotOptions: {
      bar: { horizontal: true, barHeight: '70%', distributed: true, startingShape: 'rounded', borderRadius: 7 }
    },
    grid: {
      strokeDashArray: 10,
      borderColor: borderColor,
      xaxis: { lines: { show: true } },
      yaxis: { lines: { show: false } },
      padding: { top: -35, bottom: -12 }
    },
    colors: [
      config.colors.primary,
      config.colors.info,
      config.colors.success,
      config.colors.secondary,
      config.colors.danger,
      config.colors.warning
    ],
    dataLabels: {
      enabled: true,
      style: { colors: ['#fff'], fontWeight: 200, fontSize: '13px', fontFamily: 'Public Sans' },
      formatter: (val, opts) => horizontalBarChartConfig.labels[opts.dataPointIndex] || '',
      offsetX: 0,
      dropShadow: { enabled: false }
    },
    labels: [],
    series: [{ data: [] }],
    xaxis: {
      categories: ['10','9','8','7','6','5','4','3','2','1'],
      axisBorder: { show: false },
      axisTicks: { show: false },
      labels: { style: { colors: labelColor, fontSize: '13px' }, formatter: val => `${val}` }
    },
    yaxis: { max: 2000, labels: { style: { colors: [labelColor], fontFamily: 'Public Sans', fontSize: '13px' } } },
    tooltip: {
      enabled: true,
      style: { fontSize: '12px' },
      onDatasetHover: { highlightDataSeries: false },
      custom: ({ series, seriesIndex, dataPointIndex }) =>
        '<div class="px-3 py-2">' + '<span>' + series[seriesIndex][dataPointIndex] + '</span>' + '</div>'
    },
    legend: { show: false }
  };

  fetch(requestUrl)
    .then(response => {
      if (!response.ok) throw new Error('HTTP error ' + response.status);
      return response.json();
    })
    .then(data => {
      if (Array.isArray(data) && data.length > 0) {
        horizontalBarChartConfig.labels = data.map(item => item.descripcion || '');
        horizontalBarChartConfig.series[0].data = data.map(item => parseInt(item.cantidad) || 0);

        if (horizontalBarChartEl) {
          const horizontalBarChart = new ApexCharts(horizontalBarChartEl, horizontalBarChartConfig);
          horizontalBarChart.render();
        }
      } else {
        console.error('Los datos JSON no tienen el formato esperado.');
      }
    })
    .catch(error => console.error('Error al cargar los datos:', error));

  // Radial Bar Chart
  function radialBarChart(color, value, show) {
    return {
      chart: { height: show === 'true' ? 58 : 53, width: show === 'true' ? 58 : 43, type: 'radialBar' },
      plotOptions: {
        radialBar: {
          hollow: { size: show === 'true' ? '45%' : '33%' },
          dataLabels: { show: show === 'true', value: { offsetY: -10, fontSize: '15px', fontWeight: 500, fontFamily: 'Public Sans', color: headingColor } },
          track: { background: config.colors_label.secondary }
        }
      },
      stroke: { lineCap: 'round' },
      colors: [color],
      grid: { padding: { top: show === 'true' ? -12 : -15, bottom: show === 'true' ? -17 : -15, left: show === 'true' ? -17 : -5, right: -15 } },
      series: [value],
      labels: show === 'true' ? [''] : ['Progress']
    };
  }

  document.querySelectorAll('.chart-progress').forEach(chartProgressEl => {
    const color = config.colors[chartProgressEl.dataset.color],
      series = chartProgressEl.dataset.series,
      progress_variant = chartProgressEl.dataset.progress_variant;
    const optionsBundle = radialBarChart(color, series, progress_variant);
    const chart = new ApexCharts(chartProgressEl, optionsBundle);
    chart.render();
  });

  










const dtSelector = '.datatables-academy-course';
const dtEl = $(dtSelector);

const logoObj = {
  ADMINISTRADOR: '<span class="badge bg-label-danger p-2"><i class="ti ti-users-group ti-md"></i></span>',
  OPERADOR: '<span class="badge bg-label-warning p-2"><i class="ti ti-user-cog ti-md"></i></span>',
  USUARIO: '<span class="badge bg-label-info p-2"><i class="ti ti-shopping-cart ti-md"></i></span>',
  CLIENTE: '<span class="badge bg-label-success p-2"><i class="ti ti-woman ti-md"></i></span>'
};

if (!dtEl.length) return;

const dt = dtEl.DataTable({
  ajax: { url: base_url + "Dashboard/getTopUsuario", dataSrc: '' },
  columns: [
    { data: '' },
    { data: 'id' },
    { data: 'nombre' },
   
    { data: 'time' },
    { data: 'status' },
    { data: 'ingresos' }
  ],
  columnDefs: [
    {
      targets: 0,
      className: 'control',
      searchable: false,
      orderable: false,
      responsivePriority: 2,
      render: () => ''
    },
    {
      targets: 1,
      orderable: false,
      searchable: false,
      checkboxes: true,
      render: () => '<input type="checkbox" class="dt-checkboxes form-check-input">',
      checkboxes: { selectAllRender: '<input type="checkbox" class="form-check-input">' }
    },
    {
      targets: 2,
      responsivePriority: 2,
      render: (data, type, full) => {
        const courseTitle = full['nombre'];
        const author = full['rol'];
        const empresa = full['empresa']; // ✅ Mostrar empresa
        const image = full['fotousuario'] ;

        let leftHtml = '';
        if (image) {
          const baseAssets = (typeof assetsPath !== 'undefined') ? assetsPath : '';
          leftHtml = `<img src="${baseAssets}img/avatars/${escapeHtml(image)}" alt="icon" class="me-2 rounded" style="width:44px;height:44px;object-fit:cover;">`;
        } else {
          const initial = escapeHtml((courseTitle.charAt(0) || 'C').toUpperCase());
          leftHtml = `<div class="me-2 rounded" style="width:44px;height:44px;background:#F5F5F7;display:flex;align-items:center;justify-content:center;font-weight:600;color:#8A7FF0">${initial}</div>`;
        }

        return `
          <div class="d-flex align-items-center">
            ${leftHtml}
            <div class="d-flex flex-column">
              <span class="fw-semibold text-truncate" style="max-width:420px">${escapeHtml(courseTitle)}</span>
              <small class="text-muted">${escapeHtml(author)}</small>
              <small class="text-primary">${escapeHtml(empresa)}</small> <!-- ✅ Empresa debajo del rol -->
            </div>
          </div>`;
      }
    },
    {
      targets: 3,
      responsivePriority: 3,
      render: (data, type, full) => {
        const raw = data || full['time'] || '00:00:00.000';
        return `<div class="text-nowrap">${escapeHtml(formatTimeHumane(String(raw)))}</div>`;
      }
    },
    {
      targets: 4,
      render: (data, type, full) => {
        let raw = data || full['status'] || '';
        raw = String(raw).trim();
        const num = parseInt(raw.replace('%', ''), 10);
        const pct = isNaN(num) ? 0 : Math.max(0, Math.min(100, num));
        const numberLabel = full['number'] || `${pct}/100`;

        return `
          <div style="min-width:200px;">
            <div class="d-flex align-items-center" style="gap:12px">
              <div class="text-nowrap" style="width:60px">${escapeHtml(pct + '%')}</div>
              <div style="flex:1">
                <div style="background:#F1F1F5;height:8px;border-radius:8px;overflow:hidden">
                  <div style="width:${pct}%;height:100%;background:#7C4DFF;border-radius:8px"></div>
                </div>
              </div>
              <div class="text-muted text-nowrap" style="width:60px;text-align:right">${escapeHtml(String(numberLabel))}</div>
            </div>
          </div>`;
      }
    },
    {
      targets: 5,
      orderable: false,
      searchable: false,
      render: (data, type, full) => {
        const usuarios = full['ingresos'] || data || 0;
        const libros = full['note'] || full['books'] || 0;
        const videos = full['anulados'] || full['videos'] || 0;

        // 👇 Espacio aumentado entre íconos y números
        return `
          <div class="d-flex align-items-center" style="gap:40px">
            <div class="text-center" style="min-width:50px;">
              <div style="color:#7C4DFF;font-size:18px;"><i class="ti ti-users"></i></div>
              <small class="d-block text-muted" style="margin-top:6px;">${escapeHtml(String(usuarios))}</small>
            </div>
            <div class="text-center" style="min-width:50px;">
              <div style="color:#13C2C2;font-size:18px;"><i class="ti ti-book"></i></div>
              <small class="d-block text-muted" style="margin-top:6px;">${escapeHtml(String(libros))}</small>
            </div>
            <div class="text-center" style="min-width:50px;">
              <div style="color:#FF6B6B;font-size:18px;"><i class="ti ti-video"></i></div>
              <small class="d-block text-muted" style="margin-top:6px;">${escapeHtml(String(videos))}</small>
            </div>
          </div>`;
      }
    }
  ],
  order: [[2, 'desc']],
  dom: '<"card-header py-sm-0"<"head-label text-center">f>t<"row mx-4"<"col-sm-6 col-12 text-center text-xl-start pb-2 pb-xl-0 px-0"i><"col-sm-6 col-12 d-flex justify-content-center justify-content-xl-end px-0"p>>',
  lengthMenu: [5],
  language: { sLengthMenu: '_MENU_', search: '', searchPlaceholder: 'Nombres y Apellidos' },
  responsive: {
    details: {
      type: 'column',
      display: $.fn.dataTable.Responsive.display.modal({
        header: row => 'Detalles de ' + (row.data()['nombre'] || 'Usuario')
      })
    }
  }
});

$('div.head-label').html('<h5 class="card-title mb-0 text-nowrap">Acceso de Usuarios al Sistema</h5>');

// Helpers
function escapeHtml(text) {
  if (text === null || text === undefined) return '';
  return String(text)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
}

function formatTimeHumane(raw) {
  const main = raw.split('.')[0];
  const parts = main.split(':');
  if (parts.length < 2) return raw;
  const h = parseInt(parts[0], 10) || 0;
  const m = parseInt(parts[1], 10) || 0;
  if (h === 0 && m === 0 && parts.length === 3) {
    const s = parseInt(parts[2], 10) || 0;
    return `${s}s`;
  }
  return `${h}h ${m}m`;
}

})();