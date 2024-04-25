$(document).ready(function() {
    const yearSelect = document.getElementById('year');
    const monthSelect = document.getElementById('month');
    const specificMonthRadio = document.getElementById('specific-month');
    const thisMonthRadio = document.getElementById('this-month');
  
    // Add event listener to the month select element
    monthSelect.addEventListener('change', function() {
      const year = yearSelect.value;
      const month = monthSelect.value;
  
      if (year && month) {
        const url = `attendance.php?year=${year}&month=${month}&filterOption=specific-month`;
        window.location.href = url;
      }
    });
  
    // Add event listener to the year select element
    yearSelect.addEventListener('change', function() {
      const year = yearSelect.value;
      const month = monthSelect.value;
  
      if (month) {
        const url = `attendance.php?year=${year}&month=${month}&filterOption=specific-month`;
        window.location.href = url;
      }
    });
  
    // Set the selected values of the year and month select elements
    const urlParams = new URLSearchParams(window.location.search);
    const year = urlParams.get('year');
    const month = urlParams.get('month');
    const filterOption = urlParams.get('filterOption');
  
    if (year) {
      yearSelect.value = year;
    }
    if (month) {
      monthSelect.value = month;
    }
  
    // Set the checked property of the radio buttons based on the filterOption parameter
    specificMonthRadio.checked = filterOption === 'specific-month';
    thisMonthRadio.checked = filterOption!== 'specific-month';
  
    // Add event listener to the "This Month" radio button
    thisMonthRadio.addEventListener('click', function() {
      const url = 'attendance.php';
      window.location.href = url;
    });
  });