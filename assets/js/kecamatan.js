document.addEventListener("DOMContentLoaded", function () {
  const kecamatanSelect = document.getElementById("kecamatanSelect");
  const dataSection = document.getElementById("dataSection");
  const selectedKecamatan = document.getElementById("selectedKecamatan");
  const jobTableBody = document.querySelector("#jobTableBody");
  const toKelurahanButton = document.getElementById("toKelurahan");

  let ageChart;
  let genderChart;

  // Get kabupatenId from URL
  const urlParams = new URLSearchParams(window.location.search);
  const kabupatenId = urlParams.get("kabupaten_id");

  // Fetch kecamatan list
  if (kabupatenId) {
    fetch(`http://demografidesa.my.id/api/demografi/kecamatan/${kabupatenId}`)
      .then((response) => response.json())
      .then((data) => {
        data.forEach((kecamatan) => {
          const option = document.createElement("option");
          option.value = kecamatan.kecamatan_id;
          option.textContent = kecamatan.nama_kecamatan;
          kecamatanSelect.appendChild(option);
        });
      })
      .catch((error) => {
        console.error("Error fetching kecamatan list:", error);
      });
  }

  // Handle kecamatan selection
  kecamatanSelect.addEventListener("change", async function () {
    const kecamatanId = kecamatanSelect.value;

    try {
      // Fetch Data
      const kecamatanResponse = await fetch(
        `http://demografidesa.my.id/api/demografi/kecamatan/detail/${kecamatanId}`
      );
      const kecamatanData = await kecamatanResponse.json();

      const genderResponse = await fetch(
        `http://demografidesa.my.id/api/demografi/kecamatan/${kecamatanId}/gender`
      );
      const genderData = await genderResponse.json();

      const ageResponse = await fetch(
        `http://demografidesa.my.id/api/demografi/kecamatan/${kecamatanId}/age`
      );
      const ageData = await ageResponse.json();

      const jobsResponse = await fetch(
        `http://demografidesa.my.id/api/demografi/kecamatan/${kecamatanId}/jobs`
      );
      const jobsData = await jobsResponse.json();

      // Update Data Section
      if (dataSection) dataSection.style.display = "block";
      if (selectedKecamatan)
        selectedKecamatan.innerText = kecamatanData.nama_kecamatan;

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

      // Update button to navigate to Kelurahan
      if (toKelurahanButton) {
        toKelurahanButton.style.display = "block";
        toKelurahanButton.onclick = function () {
          window.location.href = `kelurahan.php?kecamatanId=${kecamatanId}`;
        };
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
