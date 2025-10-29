/**
 * DataTables Basic - corregido
 */

'use strict';

let fv, offCanvasEl;

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    // Aquí puedes poner cualquier inicialización adicional
  })();
});

// DataTable (jQuery)
$(function () {
  var dt_basic_table = $('.datatables-basic'),
      dt_complex_header_table = $('.dt-complex-header'),
      dt_row_grouping_table = $('.dt-row-grouping'),
      dt_multilingual_table = $('.dt-multilingual'),
      dt_basic;

  // DataTable with buttons
  if (dt_basic_table.length) {
    dt_basic = dt_basic_table.DataTable({
      ajax: {
        url: base_url + "Usuarios/listar",
        dataSrc: ''
      },
      columns: [
        { data: '' },             // control responsive
        { data: 'id' },           // checkbox / id
        { data: 'id' },           // id duplicado (oculto)
        { data: 'nombre' },       // avatar + nombre + apellidos
        { data: 'apellidos' },    // apellidos (para fallback)
        { data: 'fecharegistro' },
        { data: 'dni' },
        { data: 'estado' },
        { data: 'acciones' }      // Acciones, vienen del controlador
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          searchable: false,
          responsivePriority: 2,
          targets: 0,
          render: function () {
            return '';
          }
        },
        {
          // Checkboxes
          targets: 1,
          orderable: false,
          searchable: false,
          responsivePriority: 3,
          checkboxes: true,
          render: function () {
            return '<input type="checkbox" class="dt-checkboxes form-check-input">';
          },
          checkboxes: {
            selectAllRender: '<input type="checkbox" class="form-check-input">'
          }
        },
        {
          // Ocultar columna duplicada de ID
          targets: 2,
          searchable: false,
          visible: false
        },
        {
          // Avatar image/badge, Name and post
          targets: 3,
          responsivePriority: 4,
          render: function (data, type, full) {
            // full puede contener distintos nombres según tu backend; usamos fallbacks seguros
            var $user_img = full['fotousuario'] || full['foto'] || '';
            // Priorizar campos: nombre -> nombres -> nombre_completo
            var $name = full['nombre'] || full['nombres'] || '';
            var $post = full['apellidos'] || full['apellido'] || '';
            var $output;

            if ($user_img) {
              // Asegúrate que assetsPath esté definido en tu entorno
              $output = '<img src="' + (typeof assetsPath !== 'undefined' ? assetsPath : '') + 'img/avatars/' + $user_img + '" alt="Avatar" class="rounded-circle">';
            } else {
              // Evitar match sobre undefined; forzar string
              var safeName = String($name || ($post || '')).trim();
              // obtener iniciales de forma segura
              var initialsArr = safeName.match(/\b\w/g) || [];
              var initials = ((initialsArr.shift() || '') + (initialsArr.pop() || '')).toUpperCase();
              if (!initials) {
                initials = (safeName.charAt(0) || 'U').toUpperCase();
              }

              var states = ['success', 'danger', 'warning', 'info', 'primary', 'secondary'];
              var stateNum = Math.floor(Math.random() * states.length);
              var $state = states[stateNum];

              $output = '<span class="avatar-initial rounded-circle bg-label-' + $state + '">' + initials + '</span>';
            }

            return `
              <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                  <div class="avatar me-2">${$output}</div>
                </div>
                <div class="d-flex flex-column">
                  <span class="emp_name text-truncate">${escapeHtml($name)}</span>
                  <small class="emp_post text-truncate text-muted">${escapeHtml($post)}</small>
                </div>
              </div>`;
          }
        },
        {
          responsivePriority: 1,
          targets: 4
        },
        {
          // Label de estado
          targets: 7, // columna 'estado' (índice 7)
          render: function (data, type, full) {
            // Normalizar el valor a número (si viene como string)
            var $status_number = typeof full['estado'] !== 'undefined' ? parseInt(full['estado'], 10) : null;
            var $status = {
              0: { title: 'Usuario Inactivo', class: 'bg-label-warning' },
              1: { title: 'Usuario Activo', class: 'bg-label-success' }
            };
            if ($status_number !== null && $status[$status_number]) {
              return `<span class="badge ${$status[$status_number].class}">${$status[$status_number].title}</span>`;
            }
            // Si no podemos determinar, retornar el valor original (sanitizado)
            return `<span class="badge bg-label-secondary">${escapeHtml(String(data || 'Desconocido'))}</span>`;
          }
        },
        // La parte de acciones queda como viene desde el controlador
        {
          targets: -1, // última columna
          title: 'acciones',
          orderable: false,
          searchable: false,
          render: function (data, type, full, meta) {
            // data ya contiene el HTML generado en PHP; es buena idea sanitizar si viene como string plano
            return data || '';
          }
        }
      ],
      order: [[2, 'desc']],
      dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>>' +
           '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>' +
           't' +
           '<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 10,
      lengthMenu: [10, 25, 50, 75, 100],
      buttons: [],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detalles de ' + (data['nombre'] || data['nombres'] || 'Usuario');
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col) {
              return col.title !== ''
                ? `<tr data-dt-row="${col.rowIndex}" data-dt-column="${col.columnIndex}"><td>${col.title}:</td><td>${escapeHtml(String(col.data))}</td></tr>`
                : '';
            }).join('');
            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      }
    });

    // Título
    $('div.head-label').html('<h5 class="card-title mb-0">Lista de Usuarios Activos</h5>');
  }

  // Ajuste de los filtros para tamaño por defecto
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);

  /**
   * Helper simple para escapar HTML en outputs construidos en JS
   * evita inyección si los datos vienen sin sanitizar (no reemplaza sanitización en servidor)
   */
  function escapeHtml(text) {
    if (text === null || text === undefined) return '';
    return String(text)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#039;');
  }
});
