document.addEventListener("DOMContentLoaded", function () {
  const kabupatenSelect = document.getElementById("kabupatenSelect");
  const dataSection = document.getElementById("dataSection");
  const selectedKabupaten = document.getElementById("selectedKabupaten");
  const jobTableBody = document.getElementById("jobTableBody");
  const totalPenduduk = document.getElementById("totalPenduduk");
  const totalLakiLaki = document.getElementById("totalLakiLaki");
  const totalPerempuan = document.getElementById("totalPerempuan");
  const totalKecamatan = document.getElementById("totalKecamatan");

  let ageDistributionChart;

  // Ensure the element "kabupatenSelect" exists before adding event listener
  if (kabupatenSelect) {
    kabupatenSelect.addEventListener("change", async function () {
      const kabupatenId = kabupatenSelect.value;

      try {
        // Fetch Data
        const kabupatenResponse = await fetch(
          `http://demografidesa.my.id/api/demografi/kabupaten/${kabupatenId}`
        );
        const kabupatenData = await kabupatenResponse.json();
        console.log("Kabupaten Data:", kabupatenData);

        const genderResponse = await fetch(
          `http://demografidesa.my.id/api/demografi/kabupaten/${kabupatenId}/gender`
        );
        const genderData = await genderResponse.json();
        console.log("Gender Data:", genderData);

        const ageResponse = await fetch(
          `http://demografidesa.my.id/api/demografi/kabupaten/${kabupatenId}/age`
        );
        const ageData = await ageResponse.json();
        console.log("Age Data:", ageData);

        const jobsResponse = await fetch(
          `http://demografidesa.my.id/api/demografi/kabupaten/${kabupatenId}/jobs`
        );
        const jobsData = await jobsResponse.json();
        console.log("Jobs Data:", jobsData);

        const kecamatanResponse = await fetch(
          `http://demografidesa.my.id/api/demografi/kabupaten/${kabupatenId}/kecamatan`
        );
        const kecamatanData = await kecamatanResponse.json();
        console.log("Kecamatan Data:", kecamatanData);

        // Update Data Section
        if (dataSection) dataSection.style.display = "block";
        if (selectedKabupaten)
          selectedKabupaten.innerText = kabupatenData.nama_kabupaten;

        // Update Cards
        console.log("Updating cards...");
        totalLakiLaki.innerText = genderData.laki_laki;
        totalPerempuan.innerText = genderData.perempuan;
        totalPenduduk.innerText =
          parseInt(genderData.laki_laki) + parseInt(genderData.perempuan);
        totalKecamatan.innerText = kecamatanData.length;

        console.log("Cards updated:", {
          totalLakiLaki: totalLakiLaki.innerText,
          totalPerempuan: totalPerempuan.innerText,
          totalPenduduk: totalPenduduk.innerText,
          totalKecamatan: totalKecamatan.innerText,
        });

        // Update Charts
        updateAgeDistributionChart(ageData);

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

    // Set default value
    if (kabupatenSelect.options.length > 1) {
      kabupatenSelect.value = kabupatenSelect.options[1].value;
      console.log("Default value set:", kabupatenSelect.value);
      kabupatenSelect.dispatchEvent(new Event("change"));
    }
  } else {
    console.error('Element "kabupatenSelect" tidak ditemukan di DOM!');
  }

  // Update Age Distribution Chart
  function updateAgeDistributionChart(data) {
    const chartElement = document.getElementById("ageDistributionChart");
    if (!chartElement) {
      console.error('Canvas "ageDistributionChart" tidak ditemukan!');
      return;
    }
    const ctx = chartElement.getContext("2d");
    if (ageDistributionChart) ageDistributionChart.destroy();
    ageDistributionChart = new Chart(ctx, {
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

  // Pass kabupaten ID to kecamatan page
  document
    .getElementById("kecamatanLink")
    .addEventListener("click", function () {
      const selectedKabupatenId =
        document.getElementById("kabupatenSelect").value;
      if (selectedKabupatenId) {
        window.location.href = `kecamatan.php?kabupaten_id=${selectedKabupatenId}`;
      } else {
        alert("Pilih Kabupaten terlebih dahulu.");
      }
    });

  // Retain selected kabupaten ID when navigating back from kecamatan
  const urlParams = new URLSearchParams(window.location.search);
  const kabupatenId = urlParams.get("kabupaten_id");
  if (kabupatenId) {
    document.getElementById("kabupatenSelect").value = kabupatenId;
    document
      .getElementById("kabupatenSelect")
      .dispatchEvent(new Event("change"));
  }
});
