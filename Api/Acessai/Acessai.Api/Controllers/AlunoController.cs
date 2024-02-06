using Acessai.Domain.Dtos;
using Acessai.Domain.Interfaces.Services;
using Microsoft.AspNetCore.Mvc;
using System.ComponentModel.DataAnnotations;

namespace Acessai.Api.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class AlunoController : ControllerBase
    {
        private readonly IAlunoService _alunoService;

        public AlunoController(IAlunoService alunoService)
        {
            _alunoService = alunoService;
        }

        [HttpGet("{email}")]
        public async Task<IActionResult> GetEmail([FromRoute][Required] string email)
        {
            var response = await _alunoService.GetAlunoByEmailAsync(email);

            if (response == null)
            {
                return NoContent();
            }

            return Ok(response);
        }

        [HttpPost]
        public async Task<IActionResult> Post([FromBody][Required] AlunoRequest request)
        {
            var response = await _alunoService.PostAlunoAsync(request);

            return Ok(response);
        }
    }
}
