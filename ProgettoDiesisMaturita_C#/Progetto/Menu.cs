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
    public partial class Menu : Form
    {
        public Menu()
        {
            InitializeComponent();
        }

        private void Menu_Load(object sender, EventArgs e)
        {

        }

        private void menu_RecorderButton_Click(object sender, EventArgs e)
        {
            Recorder form = new Recorder();
            form.Show();
            this.Hide();
        }

        private void menu_ModificaDatiButton_Click(object sender, EventArgs e)
        {
            ModificaDati form = new ModificaDati();
            form.Show();
            this.Hide();
        }

        private void menu_VisualizzaButton_Click(object sender, EventArgs e)
        {
            Visualizza form = new Visualizza();
            form.Show();
            this.Hide();
        }
    }
}
