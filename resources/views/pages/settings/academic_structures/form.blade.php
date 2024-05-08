  <table class="table table-row-dashed">
      <thead>
          <tr class="text-start text-gray-400 fw-bold text-uppercase">
              <th>Module</th>
              <th>Study Modes</th>
              <th>Study Period</th>
              <th></th>
          </tr>
      </thead>
      <tbody id="curriculm-modules-table">

      </tbody>
  </table>
  <button class="btn btn-sm btn-primary" type="button" id="addModuleButton">
      <i class="fa-solid fa-plus"></i> Add module
  </button>

  <script type="text/javascript">
      let addModuleButton = document.getElementById('addModuleButton');

      addModuleButton.addEventListener('click', function() {
          getModules();
      })

      async function getModules() {
          console.log('sss');
          const url = "/get-modules/";

          const response = await fetch(url, {
                  method: "GET",
              })
              .then((response) => response.text())
              .then((data) => {
                  let curriculmModules = document.getElementById('curriculm-modules-table');

                  curriculmModules.innerHTML = curriculmModules.innerHTML + data;
              })
      }
  </script>