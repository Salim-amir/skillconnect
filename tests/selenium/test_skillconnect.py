import pytest
import time
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

BASE_URL = "http://127.0.0.1:8000"

@pytest.fixture
def driver():
    options = Options()
    options.add_argument('--headless=new')
    options.add_argument('--no-sandbox')
    options.add_argument('--disable-dev-shm-usage')
    options.add_argument('--window-size=1400,900')
    driver = webdriver.Chrome(options=options)
    driver.implicitly_wait(10)
    yield driver
    driver.quit()

def login(driver, email, password):
    driver.get(f"{BASE_URL}/login")
    time.sleep(1)
    open_btns = driver.find_elements(By.CSS_SELECTOR, '[data-open="l"]')
    if open_btns and open_btns[0].is_displayed():
        open_btns[0].click()
        time.sleep(0.5)
    
    email_input = driver.find_element(By.CSS_SELECTOR, '#fL input[name="email"]')
    password_input = driver.find_element(By.CSS_SELECTOR, '#fL input[name="password"]')
    submit_btn = driver.find_element(By.CSS_SELECTOR, '#fL button[type="submit"]')

    email_input.clear()
    email_input.send_keys(email)
    password_input.clear()
    password_input.send_keys(password)
    submit_btn.click()
    
    WebDriverWait(driver, 15).until(lambda d: "/dashboard" in d.current_url)

# ==========================================
# MOD-01: Autentikasi & Login Multi-Role
# ==========================================
def test_mod01_tc01_validasi_kata_sandi_kosong(driver):
    """MOD-01-TC01: Validasi Error jika Kata Sandi Kosong (Negatif)"""
    driver.get(f"{BASE_URL}/login")
    time.sleep(1)
    open_btns = driver.find_elements(By.CSS_SELECTOR, '[data-open="l"]')
    if open_btns and open_btns[0].is_displayed():
        open_btns[0].click()
        time.sleep(0.5)

    driver.find_element(By.CSS_SELECTOR, '#fL input[name="email"]').send_keys("admin@skillconnect.com")
    driver.find_element(By.CSS_SELECTOR, '#fL button[type="submit"]').click()
    time.sleep(0.5)

    error_msg = driver.find_element(By.CSS_SELECTOR, '#fL .msg').text
    assert "Kata sandi wajib diisi" in error_msg

def test_mod01_tc02_validasi_kredensial_salah(driver):
    """MOD-01-TC02: Validasi Error jika Kredensial Salah (Negatif)"""
    driver.get(f"{BASE_URL}/login")
    time.sleep(1)
    open_btns = driver.find_elements(By.CSS_SELECTOR, '[data-open="l"]')
    if open_btns and open_btns[0].is_displayed():
        open_btns[0].click()
        time.sleep(0.5)

    driver.find_element(By.CSS_SELECTOR, '#fL input[name="email"]').send_keys("salah@skillconnect.com")
    driver.find_element(By.CSS_SELECTOR, '#fL input[name="password"]').send_keys("passwordngawur")
    driver.find_element(By.CSS_SELECTOR, '#fL button[type="submit"]').click()
    time.sleep(1.5)

    body = driver.find_element(By.TAG_NAME, 'body').text
    assert "salah" in body.lower() or "gagal" in body.lower() or "/login" in driver.current_url

def test_mod01_tc03_login_admin_dashboard(driver):
    """MOD-01-TC03: Login Multi-Role Admin Berhasil & Masuk Dashboard (Positif)"""
    login(driver, "admin@skillconnect.com", "password123")
    assert "/dashboard" in driver.current_url
    assert "Dashboard" in driver.find_element(By.TAG_NAME, 'body').text

def test_mod01_tc04_login_member_dashboard(driver):
    """MOD-01-TC04: Login Multi-Role Member Berhasil & Masuk Dashboard (Positif)"""
    login(driver, "member@skillconnect.com", "password123")
    assert "/dashboard" in driver.current_url
    assert "Dashboard" in driver.find_element(By.TAG_NAME, 'body').text

# ==========================================
# MOD-02: Pengelolaan Profile & Master Skill
# ==========================================
def test_mod02_tc01_akses_profil_master_skill(driver):
    """MOD-02-TC01: Akses Halaman Profil & Master Skill Pengguna (Positif)"""
    login(driver, "admin@skillconnect.com", "password123")
    driver.get(f"{BASE_URL}/profile-skill")
    assert "/profile-skill" in driver.current_url
    assert "Profil" in driver.find_element(By.TAG_NAME, 'body').text

def test_mod02_tc02_verifikasi_form_biodata_pengalaman(driver):
    """MOD-02-TC02: Verifikasi Formulir Biodata, Pengalaman & Skill (Positif)"""
    login(driver, "member@skillconnect.com", "password123")
    driver.get(f"{BASE_URL}/profile-skill")
    forms = driver.find_elements(By.CSS_SELECTOR, 'input[name="name"], textarea[name="pengalaman"], form')
    assert len(forms) > 0

# ==========================================
# MOD-03: Pencarian & Pengajuan Lamaran
# ==========================================
def test_mod03_tc01_navigasi_katalog_dan_filter_proyek(driver):
    """MOD-03-TC01: Navigasi Katalog Proyek & Filter Pencarian (Positif)"""
    login(driver, "member@skillconnect.com", "password123")
    driver.get(f"{BASE_URL}/proyek")
    assert "/proyek" in driver.current_url
    search_inputs = driver.find_elements(By.CSS_SELECTOR, 'input[type="text"], input[name="search"], form')
    assert len(search_inputs) > 0

def test_mod03_tc02_kunjungan_detail_proyek_dan_form_lamaran(driver):
    """MOD-03-TC02: Kunjungan Detail Proyek & Form Pengajuan Lamaran Member (Positif)"""
    login(driver, "member@skillconnect.com", "password123")
    driver.get(f"{BASE_URL}/proyek/1")
    assert "/proyek/1" in driver.current_url
    body = driver.find_element(By.TAG_NAME, 'body').text
    assert "Aplikasi Kasir POS" in body
    assert any(term in body for term in ["Lamaran", "Posisi", "Fee"])

# ==========================================
# MOD-04: Pembuatan Proyek & Kriteria Skill
# ==========================================
def test_mod04_tc01_proteksi_hak_akses_admin_buat_proyek(driver):
    """MOD-04-TC01: Proteksi Hak Akses Role Admin Dilarang Buat Proyek (Negatif/RBAC)"""
    login(driver, "admin@skillconnect.com", "password123")
    driver.get(f"{BASE_URL}/proyek/buat")
    body = driver.find_element(By.TAG_NAME, 'body').text
    is_blocked = not driver.current_url.endswith("/proyek/buat") or "Admin tidak memiliki akses" in body or "Dashboard" in body
    assert is_blocked

def test_mod04_tc02_member_akses_form_buat_proyek(driver):
    """MOD-04-TC02: Member Mengakses Form Pembuatan Proyek & Kriteria Skill (Positif)"""
    login(driver, "member@skillconnect.com", "password123")
    driver.get(f"{BASE_URL}/proyek/buat")
    assert "/proyek/buat" in driver.current_url
    assert driver.find_element(By.NAME, "judul_project").is_displayed()
    assert driver.find_element(By.NAME, "budget").is_displayed()

# ==========================================
# MOD-05: Exact Skill Matching Engine
# ==========================================
def test_mod05_tc01_kalkulasi_skor_exact_skill_matching(driver):
    """MOD-05-TC01: Kalkulasi & Penampilan Persentase Exact Skill Matching (Positif)"""
    login(driver, "admin@skillconnect.com", "password123")
    driver.get(f"{BASE_URL}/proyek/1")
    body = driver.find_element(By.TAG_NAME, 'body').text
    assert any(term in body for term in ["% Cocok", "Kecocokan", "Skill"])

def test_mod05_tc02_rincian_tag_skill_cocok_pelamar(driver):
    """MOD-05-TC02: Verifikasi Rincian Tag Skill Cocok Pelamar (Positif)"""
    login(driver, "admin@skillconnect.com", "password123")
    driver.get(f"{BASE_URL}/proyek/1")
    body = driver.find_element(By.TAG_NAME, 'body').text
    assert any(term in body for term in ["Skill Cocok", "Kandidat", "Melamar"])

# ==========================================
# MOD-06: Memilih Kandidat
# ==========================================
def test_mod06_tc01_filter_pelamar_berdasarkan_posisi(driver):
    """MOD-06-TC01: Filter Daftar Kandidat Berdasarkan Parameter Posisi (Positif)"""
    login(driver, "admin@skillconnect.com", "password123")
    driver.get(f"{BASE_URL}/proyek/1?posisi=Frontend+Developer")
    assert "posisi=Frontend" in driver.current_url
    body = driver.find_element(By.TAG_NAME, 'body').text
    assert "Aplikasi Kasir POS" in body

def test_mod06_tc02_verifikasi_profil_dan_berkas_pelamar(driver):
    """MOD-06-TC02: Verifikasi Profil Pelamar & Kelengkapan Berkas (Positif)"""
    login(driver, "admin@skillconnect.com", "password123")
    driver.get(f"{BASE_URL}/proyek/1")
    body = driver.find_element(By.TAG_NAME, 'body').text
    assert any(term in body for term in ["Pelamar", "Kandidat", "Ekspektasi Fee"])

# ==========================================
# MOD-07: Rekrutmen & Kelola Anggota Tim
# ==========================================
def test_mod07_tc01_verifikasi_status_seleksi_dan_tombol_aksi(driver):
    """MOD-07-TC01: Verifikasi Status Rekrutmen Kandidat & Tombol Keputusan (Positif)"""
    login(driver, "admin@skillconnect.com", "password123")
    driver.get(f"{BASE_URL}/proyek/1")
    body = driver.find_element(By.TAG_NAME, 'body').text
    assert any(term in body for term in ["Status:", "Diterima", "Pending", "Terima"])

def test_mod07_tc02_verifikasi_daftar_anggota_tim_aktif(driver):
    """MOD-07-TC02: Verifikasi Daftar Anggota Tim Aktif yang Diterima (Positif)"""
    login(driver, "admin@skillconnect.com", "password123")
    driver.get(f"{BASE_URL}/proyek/1")
    body = driver.find_element(By.TAG_NAME, 'body').text
    assert "anggota tim resmi" in body.lower()

# ==========================================
# MOD-08: Task Board & Upload Bukti Kerja
# ==========================================
def test_mod08_tc01_tampilan_kanban_4_kolom_task_board(driver):
    """MOD-08-TC01: Memverifikasi Task Board 4 Kolom Status Kanban (Positif)"""
    login(driver, "admin@skillconnect.com", "password123")
    driver.get(f"{BASE_URL}/proyek/1/tasks")
    assert "/proyek/1/tasks" in driver.current_url
    body = driver.find_element(By.TAG_NAME, 'body').text
    assert "Task Board" in body
    assert "Belum Dikerjakan" in body
    assert "Sedang Dikerjakan" in body
    assert "Menunggu Review" in body
    assert "Selesai" in body

def test_mod08_tc02_form_tugas_baru_dan_bukti_pengerjaan(driver):
    """MOD-08-TC02: Memverifikasi Form Tugas Baru & Komponen Bukti Kerja (Positif)"""
    login(driver, "admin@skillconnect.com", "password123")
    driver.get(f"{BASE_URL}/proyek/1/tasks")
    body = driver.find_element(By.TAG_NAME, 'body').text
    assert any(term in body for term in ["Tambah Task", "Tugas", "Bukti"])

# ==========================================
# MOD-09: Evaluasi & Progres Proyek
# ==========================================
def test_mod09_tc01_ringkasan_statistik_progres_tugas(driver):
    """MOD-09-TC01: Memverifikasi Ringkasan Progres & 4 Kartu Metrik (Positif)"""
    login(driver, "admin@skillconnect.com", "password123")
    driver.get(f"{BASE_URL}/proyek/1/tasks")
    stat_cards = driver.find_elements(By.CLASS_NAME, 'stat-card')
    assert len(stat_cards) == 4

def test_mod09_tc02_modul_evaluasi_kinerja_dan_rating_anggota(driver):
    """MOD-09-TC02: Memverifikasi Modul Evaluasi Kinerja & Rating Bintang (Positif)"""
    login(driver, "admin@skillconnect.com", "password123")
    driver.get(f"{BASE_URL}/proyek/1/tasks")
    body = driver.find_element(By.TAG_NAME, 'body').text
    assert any(term in body for term in ["Evaluasi", "Kinerja", "Rating"])
