document.addEventListener("DOMContentLoaded", function () {
  const kelurahanSelect = document.getElementById("kelurahanSelect");
  const dataSection = document.getElementById("dataSection");
  const selectedKelurahan = document.getElementById("selectedKelurahan");
  const jobTableBody = document.querySelector("#jobTableBody");

  let ageChart;
  let genderChart;

  // Get kecamatanId from URL
  const urlParams = new URLSearchParams(window.location.search);
  const kecamatanId = urlParams.get("kecamatanId");

  // Fetch kelurahan list
  if (kecamatanId) {
    fetch(`http://demografidesa.my.id/api/demografi/kelurahan/${kecamatanId}`)
      .then((response) => response.json())
      .then((data) => {
        data.forEach((kelurahan) => {
          const option = document.createElement("option");
          option.value = kelurahan.kelurahan_id;
          option.textContent = kelurahan.nama_kelurahan;
          kelurahanSelect.appendChild(option);
        });
      })
      .catch((error) => {
        console.error("Error fetching kelurahan list:", error);
      });
  }

  // Handle kelurahan selection
  kelurahanSelect.addEventListener("change", async function () {
    const kelurahanId = kelurahanSelect.value;

    try {
      // Fetch Data
      const kelurahanResponse = await fetch(
        `http://demografidesa.my.id/api/demografi/kelurahan/${kelurahanId}`
      );
      const kelurahanData = await kelurahanResponse.json();

      const genderResponse = await fetch(
        `http://demografidesa.my.id/api/demografi/kelurahan/${kelurahanId}/gender`
      );
      const genderData = await genderResponse.json();

      const ageResponse = await fetch(
        `http://demografidesa.my.id/api/demografi/kelurahan/${kelurahanId}/age`
      );
      const ageData = await ageResponse.json();

      const jobsResponse = await fetch(
        `http://demografidesa.my.id/api/demografi/kelurahan/${kelurahanId}/jobs`
      );
      const jobsData = await jobsResponse.json();

      // Update Data Section
      if (dataSection) dataSection.style.display = "block";
      if (selectedKelurahan)
        selectedKelurahan.innerText = kelurahanData.nama_kelurahan;

      // Update Charts
      updateAgeChart(ageData);
      updateGenderChart(genderData);

      // Update Job Table
      if (jobTableBody) {
        jobTableBody.innerHTML = "";
        jobsData.forEach((job) => {
          jobTableBody.innerHTML += `  
            <tr>  
              <td>${job.nama_pekerjaan}</td>  
              <td>${job.laki_laki}</td>  
              <td>${job.perempuan}</td>  
              <td>${job.jumlah}</td>  
            </tr>`;
        });
      }
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  });

  // Update Age Chart
  function updateAgeChart(data) {
    const chartElement = document.getElementById("ageChart");
    if (!chartElement) {
      console.error('Canvas "ageChart" tidak ditemukan!');
      return;
    }
    const ctx = chartElement.getContext("2d");
    if (ageChart) ageChart.destroy();
    ageChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: [
          "0-17 Tahun",
          "18-25 Tahun",
          "26-40 Tahun",
          "41-60 Tahun",
          "> 60 Tahun",
        ],
        datasets: [
          {
            label: "Jumlah Penduduk",
            data: [
              data.usia_0_17,
              data.usia_18_25,
              data.usia_26_40,
              data.usia_41_60,
              data.usia_diatas_60,
            ],
            backgroundColor: "rgba(75, 192, 192, 0.7)",
            borderColor: "rgba(75, 192, 192, 1)",
            borderWidth: 1,
          },
        ],
      },
      options: {
        scales: { y: { beginAtZero: true } },
      },
    });
  }

  // Update Gender Chart
  function updateGenderChart(data) {
    const chartElement = document.getElementById("genderChart");
    if (!chartElement) {
      console.error('Canvas "genderChart" tidak ditemukan!');
      return;
    }
    const ctx = chartElement.getContext("2d");
    if (genderChart) genderChart.destroy();
    genderChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["Laki-Laki", "Perempuan"],
        datasets: [
          {
            label: "Jumlah Penduduk",
            data: [data.laki_laki, data.perempuan],
            backgroundColor: [
              "rgba(54, 162, 235, 0.7)",
              "rgba(255, 99, 132, 0.7)",
            ],
            borderColor: ["rgba(54, 162, 235, 1)", "rgba(255, 99, 132, 1)"],
            borderWidth: 1,
          },
        ],
      },
      options: {
        scales: { y: { beginAtZero: true } },
      },
    });
  }
});
