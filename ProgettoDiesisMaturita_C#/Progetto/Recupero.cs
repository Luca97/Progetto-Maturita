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
    public partial class Recupero : Form
    {
        public Recupero()
        {
            InitializeComponent();
        }

        private void button4_Click(object sender, EventArgs e)
        {
            BufferUtenti newVett = new BufferUtenti();

            //newVett.L




            Accesso form = new Accesso();
            form.Show();
            this.Hide();
        }

        private void Recupero_BackButton_Click(object sender, EventArgs e)
        {
            Accesso form = new Accesso();
            form.Show();
            this.Hide();
        }
    }
}
