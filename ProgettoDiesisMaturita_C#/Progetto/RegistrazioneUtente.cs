using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Net;

namespace Progetto
{
    public partial class RegistrazioneUtente : Form
    {
        public RegistrazioneUtente()
        {
            InitializeComponent();
        }

        private void textBox4_TextChanged(object sender, EventArgs e)
        {
            textBox4.UseSystemPasswordChar = true;
        }

        private void textBox5_TextChanged(object sender, EventArgs e)
        {
            textBox5.UseSystemPasswordChar = true;
        }

        private void button4_Click(object sender, EventArgs e)
        {
            String username = textBox1.Text; //recupera stringa usn dall'interfaccia
            String email = textBox2.Text; //recupera stringa e-mail dall'interfaccia
            String confermaEmail = textBox3.Text; //recupera stringa conferma e-mail dall'interfaccia
            String password = textBox4.Text; //recupera stringa psw dall'interfaccia
            String confermaPassword = textBox5.Text; //recupera stringa conferma psw dall'interfaccia

            bool emailOK = false; //variabile per il controllo tra email e confermaEmail
            bool passwordOK = false; //variabile per il controllo tra psw e conferma psw
            

            
            do
            {

                if (email != confermaEmail)
                {
                    MessageBox.Show("Riprova a digitare le e-mail!!!","LE E-MAIL NON CORRISPONDONO!!!", MessageBoxButtons.OK, MessageBoxIcon.Warning);//messaggio di errore sull'inugualianza delle email
                    textBox2.Text = "";
                    textBox3.Text = "";
                }
                if (password != confermaPassword)
                {
                    MessageBox.Show("Riprova a digitare le password!!!", "LE PASSWORD NON CORRISPONDONO!!!", MessageBoxButtons.OK, MessageBoxIcon.Warning);//messaggio di errore sull'inugualianza delle password
                    textBox4.Text = "";
                    textBox5.Text = "";
                }
            }
            while (emailOK == false || passwordOK == false);

            BufferUtenti ricercaUtente = new BufferUtenti();

            if (ricercaUtente.CercaUtenteByUsn(username) == true)
            {
                MessageBox.Show("Cambia username!!!", "USERNAME GIA' IN USO!!!", MessageBoxButtons.OK, MessageBoxIcon.Warning);//messaggio di errore sull'inugualianza delle password
            }
            else
            {
                MessageBox.Show("Le credenziali vanno bene!!!", "PROCEDURA D'ISCRIZIONE AVVIATA!!!", MessageBoxButtons.OK);//messaggio di errore sull'inugualianza delle password
                //HttpCookie CookieUsn = new HttpCookie(username);
                //HttpCookie CookiePsw = new HttpCookie(password);
                //HttpCookie CookieEml = new HttpCookie(email);
            }



        }

        private void Registrazione_BackButton_Click(object sender, EventArgs e)
        {
            Accesso form = new Accesso();
            form.Show();
            this.Hide();
        }
    }
}
