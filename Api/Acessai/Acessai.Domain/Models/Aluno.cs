using System.ComponentModel.DataAnnotations.Schema;

namespace Acessai.Domain.Models
{
    [Table("ALUNO")]
    public class Aluno : BaseModel
    {
        [Column("NOME")]
        public string Nome { get; set; }

        [Column("EMAIL")]
        public string Email { get; set; }

        [Column("SENHA")]
        public string Senha { get; set; }

        [Column("ASSISTENCIA")]
        public string Assistencia { get; set; }

        [Column("DATA_HORA_CRIACAO")]
        public DateTime DataHoraCriacao { get; set; }
    }
}
