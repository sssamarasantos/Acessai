using Acessai.Domain.Dtos;
using Acessai.Domain.Models;
using AutoMapper;

namespace Acessai.Domain.Profiles
{
    public class AlunoProfile : Profile
    {
        public AlunoProfile()
        {
            CreateMap<AlunoRequest, Aluno>()
                .ForMember(dest => dest.DataHoraCriacao, opt => opt.MapFrom(src => DateTime.Now));
        }
    }
}
