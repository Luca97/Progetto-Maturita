using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Progetto
{
    public partial class Accesso : Form
    {
        public Accesso()
        {
            InitializeComponent();
        }      

        private void Accesso_AccediButton_Click(object sender, EventArgs e)
        {
            string Usn = textBox1.Text;
            string Psw = textBox2.Text;

//            BufferUtenti listaUtenti = new BufferUtenti();

            Menu form = new Menu();
            form.Show();
            this.Close();

        }

        private void Accesso_RegistratiButton_Click(object sender, EventArgs e)
        {
            RegistrazioneUtente form = new RegistrazioneUtente();
            form.Show();
            this.Hide();

        }

        private void Accesso_DimenticatoButton_Click(object sender, EventArgs e)
        {
            Recupero form = new Recupero();
            form.Show();
            this.Hide();
        }
    }
}
