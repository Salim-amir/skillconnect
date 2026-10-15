import pytest
import time
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

BASE_URL = "http://127.0.0.1:8000"

@pytest.fixture(scope="module")
def driver():
    options = Options()
    options.add_argument("--headless=new")
    options.add_argument("--disable-gpu")
    options.add_argument("--no-sandbox")
    options.add_argument("--window-size=1280,800")
    
    driver = webdriver.Chrome(options=options)
    driver.implicitly_wait(10)
    yield driver
    driver.quit()

def test_uc01_homepage_branding(driver):
    """UC-01: Membuka Halaman Utama SkillConnect & Verifikasi Branding"""
    driver.get(BASE_URL + "/")
    assert "SkillConnect" in driver.title or "SKILL CONNECT" in driver.page_source

def test_uc02_login_form_empty_password_validation(driver):
    """UC-02: Validasi Error Form Login jika Kata Sandi Kosong"""
    driver.get(BASE_URL + "/login")
    
    # Buka modal login jika tersembunyi
    open_btn = driver.find_elements(By.CSS_SELECTOR, '[data-open="l"]')
    if open_btn:
        driver.execute_script("arguments[0].click();", open_btn[0])
        time.sleep(0.5)
        
    email_input = driver.find_element(By.CSS_SELECTOR, '#fL input[name="email"]')
    email_input.clear()
    email_input.send_keys("admin@skillconnect.com")
    
    pw_input = driver.find_element(By.CSS_SELECTOR, '#fL input[name="password"]')
    pw_input.clear()
    
    submit_btn = driver.find_element(By.CSS_SELECTOR, '#fL button[type="submit"]')
    submit_btn.click()
    time.sleep(0.5)
    
    msg_el = driver.find_element(By.CSS_SELECTOR, '#fL .msg')
    assert "Kata sandi wajib diisi." in msg_el.text

def test_uc03_login_admin_success(driver):
    """UC-03: Login Admin dengan Kredensial Valid & Masuk ke Dashboard Admin"""
    driver.get(BASE_URL + "/login")
    
    open_btn = driver.find_elements(By.CSS_SELECTOR, '[data-open="l"]')
    if open_btn:
        driver.execute_script("arguments[0].click();", open_btn[0])
        time.sleep(0.5)
        
    email_input = driver.find_element(By.CSS_SELECTOR, '#fL input[name="email"]')
    email_input.clear()
    email_input.send_keys("admin@skillconnect.com")
    
    pw_input = driver.find_element(By.CSS_SELECTOR, '#fL input[name="password"]')
    pw_input.clear()
    pw_input.send_keys("password123")
    
    submit_btn = driver.find_element(By.CSS_SELECTOR, '#fL button[type="submit"]')
    submit_btn.click()
    
    WebDriverWait(driver, 10).until(EC.url_contains("/dashboard"))
    assert "/dashboard" in driver.current_url
    assert "Dashboard" in driver.page_source

def test_uc04_admin_menu_pengguna(driver):
    """UC-04: Navigasi Menu Kelola Pengguna oleh Admin"""
    driver.get(BASE_URL + "/admin/pengguna")
    WebDriverWait(driver, 10).until(EC.url_contains("/admin/pengguna"))
    assert "/admin/pengguna" in driver.current_url
    assert "Kelola Pengguna" in driver.page_source

def test_uc05_admin_menu_laporan(driver):
    """UC-05: Navigasi Menu Laporan Admin & Tampilan Detail Data"""
    driver.get(BASE_URL + "/admin/laporan")
    WebDriverWait(driver, 10).until(EC.url_contains("/admin/laporan"))
    assert "/admin/laporan" in driver.current_url
    assert "Laporan" in driver.page_source

def test_uc06_smoke_riwayat_transaksi(driver):
    """UC-06: Smoke Testing Halaman Riwayat Transaksi Admin"""
    driver.get(BASE_URL + "/admin/transaksi")
    WebDriverWait(driver, 10).until(EC.url_contains("/admin/transaksi"))
    assert "/admin/transaksi" in driver.current_url
    assert "Riwayat Transaksi" in driver.page_source

def test_uc07_katalog_proyek(driver):
    """UC-07: Akses Halaman Proyek & Navigasi Pencarian Proyek"""
    driver.get(BASE_URL + "/proyek")
    WebDriverWait(driver, 10).until(EC.url_contains("/proyek"))
    assert "/proyek" in driver.current_url
    assert "Proyek" in driver.page_source
